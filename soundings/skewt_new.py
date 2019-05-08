
import matplotlib
from matplotlib import pyplot as plt
from matplotlib import cm

from mpl_toolkits.axes_grid1.inset_locator import inset_axes

from metpy.plots import SkewT, Hodograph
from metpy.units import units
from metpy.calc import get_wind_components,thermo

from scipy import interpolate

import sharppy
import sharppy.sharptab.profile as profile
import sharppy.sharptab.interp as interp
import sharppy.sharptab.winds as winds
import sharppy.sharptab.utils as utils
import sharppy.sharptab.params as params
import sharppy.sharptab.thermo as thermo

import numpy as np

import warnings
import sys
import re


warnings.filterwarnings('ignore')


def var_read(var_type):
    """ """
    
    real_data = True
    need_orig_array = True
    data_array = np.asarray([[0] * 9])
    
    while real_data:
        
        data = map(float, re.findall(r'[-+]?\d*\.\d+|\d+', var_type.readline()))
        
        if len(data) < 1:
            real_data = False
            
        else:
            
            if need_orig_array:
                
                data_array = np.asarray(data)
                need_orig_array = False
                
            else:
                
                temp_data_array=np.asarray(data)
                data_array = np.vstack((data_array, temp_data_array))

    return data_array


def read_imet(lid, ascent):
    """Read the imetOS2 data"""
            
    url_base = f'static/soundings/launches/{lid}_{ascent}/{lid}_{ascent}_'
    
    standard_levels_file = url_base + '_STDLVLS.txt'
    significant_levels_file = url_base + '_SIGLVLS.txt'
    summaries_file = url_base + '_SUMMARY.txt'

    def skip_lines(file, lines):
        
        for _ in range(lines):
            file.readline()

    def test_for_keyword(file, keyword):
        
        for _ in range(200):
            
            text = file.readline()
            if keyword in text:
                break
        
        return text

    # Read standard level data
    with open(standard_levels_file, 'r') as f:
        
        skip_lines(f, 4)
        data_std = var_read(f)

    # Read significant temperature, humidity and wind levels
    with open(significant_levels_file, 'r') as f:
        
        test_for_keyword(f, "TEMPERATURE")
        
        skip_lines(f, 4)
        data_sig_temp = var_read(f)

        f.seek(0)
        test_for_keyword(f, "SIGNIFICANT WIND")

        skip_lines(f, 4)
        data_sig_wind = var_read(f)

    # Read summary file
    with f as open(summaries_file, 'r'):
        
        test_for_keyword(f, "Launched")
        data_time = re.findall(r"[-+]?\d*\.\d+|\d+", text)
    
    data_sig = np.vstack((data_sig_wind, data_sig_temp))
    data_sig = data_sig[data_sig[:, 0].argsort()][::-1]

    return (data_std, data_sig, data_time)


def unique(arr):
    """Remove duplicate rows from list"""
    
    order = np.lexsort(arr.T)
    arr = arr[order]
    
    diff = np.diff(arr, axis=0)
    
    ui = np.ones(len(arr), 'bool')
    ui[1:] = (diff != 0).any(axis=1)
    
    return arr[ui]


def thetas(theta, presvals):
    """ """

    shift = theta + thermo.ZEROCNK
    power = np.power((1000 / presvals),thermo.ROCP))
    
    return (shift / power) - thermo.ZEROCNK


def generate_kvum(launch, ascent):
    """Generate KVUM image from soundings data"""
    
    data_std, data_sig, tdata = read_imet(launch,ascent)
    data_all = np.vstack((data_sig,data_std))
    data_all = data_all[data_all[:,0].argsort()][::-1]
    p = data_all[:,0]
    p_std = data_std[:,0]
    T = data_all[:,1]
    Td = data_all[:,2]
    RH = data_all[:,3]
    h = data_all[:,4]
    h = [i-np.min(h) for i in h] #reduce to ground level
    spd = data_all[:,5]
    spd_std = data_std[:,5]
    direc = data_all[:,6]
    direc_std = data_std[:,6]

    prof = profile.create_profile(profile='default', pres=p, hght=h, tmpc=T,dwpc=Td, wspd=spd,
    wdir=direc,strictQC=False)

    #interpolate pressure to important height levels
    h_new = [1000] + [3000, 6000, 9000, 12000, 15000]
    for i in range(len(h_new)):
        if np.max(h)>h_new[i]:
            index=i
    h_new_labels = ['1 km','3 km','6 km','9 km','12 km','15 km']
    h_new_labels = h_new_labels[0:index+1]
    p_interped_func = interpolate.interp1d(h, p)
    p_interped = p_interped_func(h_new[0:index+1])

    # Add units to the data arrays
    p = p * units.mbar
    p_std = p_std * units.mbar
    T = T * units.degC
    Td = Td * units.degC
    spd = spd * units.knot
    spd_std = spd_std * units.knot
    direc = direc * units.deg
    direc_std = direc_std * units.deg

    # Convert wind speed and direction to components
    u, v = get_wind_components(spd, direc)
    u_std, v_std = get_wind_components(spd_std, direc_std)

    #PARCEL CALCULATIONS with sharppy
    sfcpcl = params.parcelx( prof, flag=1 ) # Surface Parcel
    fcstpcl = params.parcelx( prof, flag=2 ) # Forecast Parcel
    mupcl = params.parcelx( prof, flag=3 ) # Most-Unstable Parcel
    mlpcl = params.parcelx( prof, flag=4 ) # 100 mb Mean Layer Parcel

    sfc = prof.pres[prof.sfc]
    p3km = interp.pres(prof, interp.to_msl(prof, 3000.))
    p6km = interp.pres(prof, interp.to_msl(prof, 6000.))
    p1km = interp.pres(prof, interp.to_msl(prof, 1000.))
    mean_3km = winds.mean_wind(prof, pbot=sfc, ptop=p3km)
    sfc_6km_shear = winds.wind_shear(prof, pbot=sfc, ptop=p6km)
    sfc_3km_shear = winds.wind_shear(prof, pbot=sfc, ptop=p3km)
    sfc_1km_shear = winds.wind_shear(prof, pbot=sfc, ptop=p1km)
    srwind = params.bunkers_storm_motion(prof)
    srh3km = winds.helicity(prof, 0, 3000., stu = srwind[0], stv = srwind[1])
    srh1km = winds.helicity(prof, 0, 1000., stu = srwind[0], stv = srwind[1])

    stp_fixed = params.stp_fixed(sfcpcl.bplus, sfcpcl.lclhght, srh1km[0], utils.comp2vec(sfc_6km_shear[0], sfc_6km_shear[1])[1])
    ship = params.ship(prof)
    eff_inflow = params.effective_inflow_layer(prof)
    ebot_hght = interp.to_agl(prof, interp.hght(prof, eff_inflow[0]))
    etop_hght = interp.to_agl(prof, interp.hght(prof, eff_inflow[1]))
    effective_srh = winds.helicity(prof, ebot_hght, etop_hght, stu = srwind[0], stv = srwind[1])
    ebwd = winds.wind_shear(prof, pbot=eff_inflow[0], ptop=eff_inflow[1])
    ebwspd = utils.mag( ebwd[0], ebwd[1] )
    scp = params.scp(mupcl.bplus, effective_srh[0], ebwspd)
    stp_cin = params.stp_cin(mlpcl.bplus, effective_srh[0], ebwspd, mlpcl.lclhght, mlpcl.bminus)

    indices = {'SBCAPE': [int(sfcpcl.bplus), 'J/kg'],\
               'SBCIN': [int(sfcpcl.bminus), 'J/kg'],\
               'SBLCL': [int(sfcpcl.lclhght), 'm AGL'],\
               'SBLFC': [int(sfcpcl.lfchght), 'm AGL'],\
               'SBEL': [int(sfcpcl.elhght), 'm AGL'],\
               'SBLI': [int(sfcpcl.li5), 'C'],\
               'MLCAPE': [int(mlpcl.bplus), 'J/kg'],\
               'MLCIN': [int(mlpcl.bminus), 'J/kg'],\
               'MLLCL': [int(mlpcl.lclhght), 'm AGL'],\
               'MLLFC': [int(mlpcl.lfchght), 'm AGL'],\
               'MLEL': [int(mlpcl.elhght), 'm AGL'],\
               'MLLI': [int(mlpcl.li5), 'C'],\
               'MUCAPE': [int(mupcl.bplus), 'J/kg'],\
               'MUCIN': [int(mupcl.bminus), 'J/kg'],\
               'MULCL': [int(mupcl.lclhght), 'm AGL'],\
               'MULFC': [int(mupcl.lfchght), 'm AGL'],\
               'MUEL': [int(mupcl.elhght), 'm AGL'],\
               'MULI': [int(mupcl.li5), 'C'],\
               '0-1 km SRH': [int(srh1km[0]), 'm2/s2'],\
               '0-1 km Shear': [int(utils.comp2vec(sfc_1km_shear[0], sfc_1km_shear[1])[1]), 'kts'],\
               '0-3 km SRH': [int(srh3km[0]), 'm2/s2'],\
               'Eff. SRH': [int(effective_srh[0]), 'm2/s2'],\
               'EBWD': [int(ebwspd), 'kts'],\
               'PWV': [round(params.precip_water(prof), 2), 'inch'],\
               'K-index': [int(params.k_index(prof)), ''],\
               'STP(fix)': [round(stp_fixed, 1), ''],\
               'SHIP': [round(ship, 1), ''],\
               'SCP': [round(scp, 1), ''],\
               'STP(cin)': [round(stp_cin, 1), '']}

    # Set the parcel trace to be plotted as the Most-Unstable parcel.
    pcl = mupcl

    # Create a new figure. The dimensions here give a good aspect ratio
    fig = plt.figure(figsize=(10, 10))
    ax = fig.add_subplot(111, projection='skewx')
    ax.grid(True)

    pmax = 1000
    pmin = 10
    dp = -10
    presvals = np.arange(int(pmax), int(pmin)+dp, dp)

    # plot the moist-adiabats
    for t in np.arange(-10,45,5):
        tw = []
        for p in presvals:
            tw.append(thermo.wetlift(1000., t, p))
        ax.semilogy(tw, presvals, 'k-', alpha=.2)

    def thetas(theta, presvals):
        return ((theta + thermo.ZEROCNK) / (np.power((1000. / presvals),thermo.ROCP))) - thermo.ZEROCNK

    # plot the dry adiabats
    for t in np.arange(-50,110,10):
        ax.semilogy(thetas(t, presvals), presvals, 'r-', alpha=.2)

    plt.title(' OAX 140616/1900 (Observed)', fontsize=12, loc='left')
    # Plot the data using normal plotting functions, in this case using
    # log scaling in Y, as dicatated by the typical meteorological plot
    ax.semilogy(prof.tmpc, prof.pres, 'r', lw=2) # Plot the temperature profile
    ax.semilogy(prof.wetbulb, prof.pres, 'c-') # Plot the wetbulb profile
    ax.semilogy(prof.dwpc, prof.pres, 'g', lw=2) # plot the dewpoint profile
    ax.semilogy(pcl.ttrace, pcl.ptrace, 'k-.', lw=2) # plot the parcel trace 
    # An example of a slanted line at constant X
    l = ax.axvline(0, color='b', linestyle='--')
    l = ax.axvline(-20, color='b', linestyle='--')

    # Plot the effective inflow layer using blue horizontal lines
    ax.axhline(eff_inflow[0], color='b')
    ax.axhline(eff_inflow[1], color='b')

    #plt.barbs(10*np.ones(len(prof.pres)), prof.pres, prof.u, prof.v)
    # Disables the log-formatting that comes with semilogy
    ax.yaxis.set_major_formatter(plt.ScalarFormatter())
    ax.set_yticks(np.linspace(100,1000,10))
    ax.set_ylim(1050,100)
    ax.xaxis.set_major_locator(plt.MultipleLocator(10))
    ax.set_xlim(-50,50)

    # List the indices within the indices dictionary on the side of the plot.
    string = ''
    for key in np.sort(indices.keys()):
        string = string + key + ': ' + str(indices[key][0]) + ' ' + indices[key][1] + '\n'
    plt.text(1.02, 1, string, verticalalignment='top', transform=plt.gca().transAxes)

    # Draw the hodograph on the Skew-T.
    # TAS 2015-4-16: hodograph doesn't plot for some reason ...
    ax2 = plt.axes([.625,.625,.25,.25])
    below_12km = np.where(interp.to_agl(prof, prof.hght) < 12000)[0]
    u_prof = prof.u[below_12km]
    v_prof = prof.v[below_12km]
    ax2.plot(u_prof[~u_prof.mask], v_prof[~u_prof.mask], 'k-', lw=2)
    ax2.get_xaxis().set_visible(False)
    ax2.get_yaxis().set_visible(False)
    for i in range(10,90,10):
        # Draw the range rings around the hodograph.
        circle = plt.Circle((0,0),i,color='k',alpha=.3, fill=False)
        ax2.add_artist(circle)
    ax2.plot(srwind[0], srwind[1], 'ro') # Plot Bunker's Storm motion right mover as a red dot
    ax2.plot(srwind[2], srwind[3], 'bo') # Plot Bunker's Storm motion left mover as a blue dot

    ax2.set_xlim(-60,60)
    ax2.set_ylim(-60,60)
    ax2.axhline(y=0, color='k')
    ax2.axvline(x=0, color='k')

    plt.savefig('/var/www/html/soundings/launches/'+launch+'_'+ascent+'/'+launch+'_'+ascent+'_KVUM.png',dpi=150)
    #plt.show()


if __name__ == '__main__':
    generate_kvum(sys.argv[1], sys.argv[2])

