
#from matplotlib.axes import Axes
#from matplotlib.lines import Line2D
#from matplotlib.collections import LineCollection
#from matplotlib.ticker import FixedLocator, AutoLocator, ScalarFormatter
#import matplotlib.transforms as transforms
#import matplotlib.axis as maxis
#import matplotlib.artist as artist
#from matplotlib.projections import register_projection

import sys
import re
import numpy as np
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
from metpy.plots import SkewT, Hodograph
from metpy.units import units
from metpy.calc import get_wind_components,thermo
from mpl_toolkits.axes_grid1.inset_locator import inset_axes
from matplotlib import cm
from scipy import interpolate
#import sharppy
#import sharppy.sharptab.profile as profile
#import sharppy.sharptab.interp as interp
#import sharppy.sharptab.winds as winds
#import sharppy.sharptab.utils as utils
#import sharppy.sharptab.params as params
#import sharppy.sharptab.thermo as thermo
import warnings
warnings.filterwarnings('ignore')

def var_read(type):
    real_data=True
    need_orig_array=True
    while(real_data):
        #data=re.split('/|\s+|\r\n',type.readline())
        data=re.findall(r"[-+]?\d*\.\d+|\d+",type.readline())
        data = [float(i) for i in data]
        if len(data)<1:
            real_data=False
        else:
            if need_orig_array:
                data_array=np.asarray(data)
                need_orig_array=False
            else:
                temp_data_array=np.asarray(data)
                data_array = np.vstack((data_array,temp_data_array))
    try:
        data_array
    except NameError:
        data_array=np.asarray([[0]*9])

    return(data_array)

#Read the imetOS2 data
def read_imet(lid,ascent):
    #if (lid < 100):
    #   slid = "0"+str(lid)
    #else:
    #   slid = str(lid)
    slid    = str(lid)
    sascent = str(ascent)
    stdf = "/var/www/html/soundings/launches/"+slid+"_"+sascent+"/"+slid+"_"+sascent+"_STDLVLS.txt"
    sigf = "/var/www/html/soundings/launches/"+slid+"_"+sascent+"/"+slid+"_"+sascent+"_SIGLVLS.txt"
    sumf = "/var/www/html/soundings/launches/"+slid+"_"+sascent+"/"+slid+"_"+sascent+"_SUMMARY.txt"


    #READ STANDARD LEVEL DATA
    std = open(stdf, 'r', encoding="utf8", errors='ignore')
    for i in range(4): #Skip first 4 lines
        std.readline()
    data_std = var_read(std)

    #READ SIGNIFICANT TEMPERATURE/HUMIDITY LEVELS
    sig = open(sigf, 'r', encoding="utf8", errors='ignore')
    test=0
    temp=True
    while temp:
        test=test+1
        text= sig.readline()
        if "TEMPERATURE" in text:
            break
        if test==200:
            break
    for i in range(5): #Skip first 4 lines
        sig.readline()
    #print sig.readline()
    data_sig_temp = var_read(sig)
    sig.close()

    #READ SIGNIFICANT WIND LEVELS
    sig = open(sigf, 'r', encoding="utf8", errors='ignore')
    test=0
    wind=True
    while wind:
        test=test+1
        text= sig.readline()
        if "SIGNIFICANT WIND" in text:
            break
        if test==200:
            break
    for i in range(4): #Skip first 4 lines
        sig.readline()
    #print sig.readline()
    data_sig_wind = var_read(sig)
    sig.close()

    #READ SUMMARY FILE
    f = open(sumf, 'r', encoding="utf8", errors='ignore')
    summary=True
    while summary:
        test=test+1
        text= f.readline()
        if "Launched" in text:
            break
        if test==200:
            break
    data_time = re.findall(r"[-+]?\d*\.\d+|\d+", text)
    f.close()
    
    data_sig = np.vstack((data_sig_wind,data_sig_temp))
    data_sig = data_sig[data_sig[:,0].argsort()][::-1]

    return(data_std, data_sig, data_time)

#Remove duplicate rows from array
def unique(a):
    order = np.lexsort(a.T)
    a = a[order]
    diff = np.diff(a, axis=0)
    ui = np.ones(len(a), 'bool')
    ui[1:] = (diff != 0).any(axis=1) 
    return a[ui]

def thetas(theta, presvals):
    return ((theta + thermo.ZEROCNK) / (np.power((1000. / presvals),thermo.ROCP))) - thermo.ZEROCNK


launch = sys.argv[1]
ascent = sys.argv[2]

#p,h,T,Td,direc,spd,tdata = read_imet(launch,ascent)
data_std, data_sig, tdata = read_imet(launch,ascent)
data_all = np.vstack((data_sig,data_std))
data_all = data_all[data_all[:,0].argsort()][::-1]
pres_zero_indices = np.where(data_all[:,0]==0)[0] #find where pressure is zero (filler from no data)
if len(pres_zero_indices)>0:
    data_all = np.delete(data_all, pres_zero_indices[0],axis=0)
p = data_all[:,0]
p_std = data_std[:,0]
T = data_all[:,1]
Td = data_all[:,2]
RH = data_all[:,3]
#Td = 243.04*(np.log(RH/100)+((17.625*T)/(243.04+T)))/(17.625-np.log(RH/100)-((17.625*T)/(243.04+T)))
h = data_all[:,4]
h = [i-np.min(h) for i in h] #reduce to ground level
spd = data_all[:,5]
spd_std = data_std[:,5]
direc = data_all[:,6]
direc_std = data_std[:,6]

#prof = profile.create_profile(profile='default', pres=p, hght=h, tmpc=T,dwpc=Td, wspd=spd, wdir=direc,strictQC=False)

#interpolate pressure to important height levels
h_new = [1000]+[3000,6000,9000,12000,15000]
for i in range(len(h_new)):
    if np.max(h)>h_new[i]:
        index=i

if 'index' in locals(): #if highest data point is above 1000m
    h_new_labels = ['1 km','3 km','6 km','9 km','12 km','15 km']
    h_new_labels = h_new_labels[0:index+1]
else: #if highest data point is below 1000m
    h_new = [100]+[200,300,400,500,600,700,800,900]
    for i in range(len(h_new)):
        if np.max(h)>h_new[i]:
            index=i
    h_new = [np.max(h)]
    h_new_labels = [str(int(np.round(np.max(h),decimals=0)))+' m']

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

# Create a new figure. The dimensions here give a good aspect ratio
fig = plt.figure(figsize=(6.5875, 6.2125))

# Grid for plots
skew = SkewT(fig)

#PARCEL CALCULATIONS with sharppy
#sfcpcl = params.parcelx( prof, flag=1 ) # Surface Parcel
#fcstpcl = params.parcelx( prof, flag=2 ) # Forecast Parcel
#mupcl = params.parcelx( prof, flag=3 ) # Most-Unstable Parcel
#mlpcl = params.parcelx( prof, flag=4 ) # 100 mb Mean Layer Parcel

# Set axis limits and color of major grid lines
skew.ax.set_xlim(-50,50)
skew.ax.set_ylim(1020,100)
#skew.ax.set_xlim(-30,35)
#skew.ax.set_ylim(1020,300)
skew.ax.yaxis.grid(b=True,which='major',color='k',linestyle='-',linewidth=0.5, alpha=0.5)
skew.ax.xaxis.grid(b=True,which='major',color='r',linestyle='--',linewidth=0.5, alpha=0.4)
plt.subplots_adjust(right=0.87)

# Plot important lines
dry_adiabat_temprange = np.arange(-80,200,10)
dry_adiabat_temprange = dry_adiabat_temprange * units.degC
moist_adiabat_presrange = np.linspace(1020,100,100)
moist_adiabat_presrange = moist_adiabat_presrange * units.mbar
skew.plot_dry_adiabats(t0=dry_adiabat_temprange,linestyle='-',colors='#D2691E', alpha=0.4)
skew.plot_moist_adiabats(p=moist_adiabat_presrange,linestyle='-',colors='g',alpha=0.4)
skew.plot_mixing_lines(colors='b',linewidth=0.75, alpha=0.5)
plt.axvline(-10,color='r',linestyle='--',linewidth=0.75)
plt.axvline(-20,color='r',linestyle='--',linewidth=0.75)

# Set Title for SkewT image
plt.title('KVUM ', loc='left', fontsize=12)
plt.title(tdata[0]+'/'+tdata[1]+'/'+tdata[2], loc='center', fontsize=12)
plt.title(tdata[3]+":"+tdata[4]+' UTC', loc='right', fontsize=12)

# Plot the data using normal plotting functions, in this case using
# log scaling in Y, as dictated by the typical meteorological plot
skew.plot(p, T, 'r',linewidth=1.5)
skew.plot(p, Td, 'g',linewidth=1.5)
#skew.plot(mupcl.ptrace,mupcl.ttrace, 'k-.')

#skew.ax.fill_betweenx(p,T,mupcl.ttrace)

ax2 = skew.ax.twinx()
plt.yscale('log', nonposy='clip')
ax2.set_xlim(-50,50)
ax2.set_ylim(1020,100)
plt.yticks(p_interped,h_new_labels,color='r', ha='left')
ax2.yaxis.tick_left()
ax2.tick_params(direction='in', pad=-5)

#PLOT PARCEL STUFF
#plt.plot((37, 43), (mupcl.lfcpres,mupcl.lfcpres), 'r-',lw=1.5)
#ax2.annotate('LFC', xy=(40, mupcl.lfcpres-10), xytext=(40, mupcl.lfcpres-10),ha='center', color='r')
#plt.plot((37, 43), (mupcl.lclpres,mupcl.lclpres), 'g-',lw=1.5)
#ax2.annotate('LCL', xy=(40, mupcl.lclpres+50), xytext=(40, mupcl.lclpres+50),ha='center', color='g')

# Create windbarbs and hodograph
skew.plot_barbs(p, u, v, xloc=1.1)
hgt_list = [0,3000,6000,9000,np.max(h)]
hodo_color = ['r','g','y','c']
hodo_label = ['0-3km','3-6km','6-9km','>9km']
ax_hod = inset_axes(skew.ax, '40%', '40%', loc=1)
for tick in ax_hod.xaxis.get_major_ticks():
    tick.label.set_fontsize(10)
    tick.label.set_rotation(45)
for tick in ax_hod.yaxis.get_major_ticks():
    tick.label.set_fontsize(10) 
hodo = Hodograph(ax_hod, component_range=80.)
hodo.add_grid(increment=20)
for k in range(len(hgt_list)-1):
    index1 = min(range(len(h)), key=lambda i: abs(h[i]-hgt_list[k]))
    index2 = min(range(len(h)), key=lambda i: abs(h[i]-hgt_list[k+1]))
    hodo.plot(u[index1:index2+1],v[index1:index2+1],c=hodo_color[k],linewidth=2.0,label=hodo_label[k])
ax_hod.set_xticks(np.arange(-80,100,40))
ax_hod.set_yticks(np.arange(-80,100,40))
ax_hod.xaxis.set_label_text('')
ax_hod.yaxis.set_label_text('')
ax_hod.legend(loc=2,prop={'size':8})

plt.savefig('/var/www/html/soundings/launches/'+launch+'_'+ascent+'/'+launch+'_'+ascent+'_KVUM.png',dpi=150)
#plt.show()
