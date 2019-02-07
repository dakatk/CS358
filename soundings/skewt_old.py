
#from matplotlib.axes import Axes
#from matplotlib.lines import Line2D
#from matplotlib.collections import LineCollection
#from matplotlib.ticker import FixedLocator, AutoLocator, ScalarFormatter
#import matplotlib.transforms as transforms
#import matplotlib.axis as maxis
#import matplotlib.artist as artist
#from matplotlib.projections import register_projection

import numpy as np
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
from metpy.plots import SkewT, Hodograph
from metpy.calc import get_wind_components
from mpl_toolkits.axes_grid1.inset_locator import inset_axes

def var_read(type,p,tm,h,T,rh,Td,dirc,sped):
    dread = True
    while(dread):
        dummy = type.readline().split()
        if not dummy:
           dread = False
        else:
           p.append(dummy[0])
           tm.append(dummy[1])
           h.append(dummy[2])
           T.append(dummy[3])
           rh.append(dummy[4])
           Td.append(dummy[5])
           dirc.append(dummy[6])
           sped.append(dummy[7])
    return(p,tm,h,T,rh,Td,dirc,sped)

def read_imet(lid,ascent):
    import re
    #if (lid < 100):
    #   slid = "0"+str(lid)
    #else:
    #   slid = str(lid)
    slid    = str(lid)
    sascent = str(ascent)
    stdf = "/home/kgoebber/http/soundings/launches/"+slid+"_"+sascent+"/"+slid+"_"+sascent+".STD"
    sigf = "/home/kgoebber/http/soundings/launches/"+slid+"_"+sascent+"/"+slid+"_"+sascent+".SIG"
    #stdf = slid+"_00"+sascent+".STD"
    #sigf = slid+"_00"+sascent+".SIG"
    std = open(stdf, 'r')
    sig = open(sigf, 'r')

    # Empty arrays for sounding variables
    p    = []
    tm   = []
    h    = []
    T    = []
    rh   = []
    Td   = []
    dirc = []
    sped = []

    # Read Standard Level Data
    tdata = re.split('/|\s+|\r\n',std.readline())
    for i in range(19): #Skip next 19 lines
        std.readline()
    p,tm,h,T,rh,Td,dirc,sped = var_read(std,p,tm,h,T,rh,Td,dirc,sped)
    # Read Significant Level Data
    for i in range(22):
        sig.readline()
    p,tm,h,T,rh,Td,dirc,sped = var_read(sig,p,tm,h,T,rh,Td,dirc,sped)

    data = np.empty((len(p),6))
    data[:,0] = p
    data[:,1] = h
    data[:,2] = T
    data[:,3] = Td
    data[:,4] = dirc
    data[:,5] = sped
    data=data[data[:,0].argsort()][::-1]

    return(data[:,0],data[:,1],data[:,2],data[:,3],data[:,4],data[:,5],tdata)

import sys

launch = sys.argv[1]
ascent = sys.argv[2]

p,h,T,Td,dirc,sped,tdata = read_imet(launch,ascent)

u,v = get_wind_components(sped, dirc)
#print tdata

fig = plt.figure(figsize=(6.5875, 6.2125))
skew = SkewT(fig, rotation=45)

# Set axis limits and color of major grid lines
skew.ax.set_xlim(-40,45)
skew.ax.set_ylim(1020,100)
#skew.ax.set_xlim(-30,35)
#skew.ax.set_ylim(1020,300)
skew.ax.yaxis.grid(b=True,which='major',color='k',linestyle='-')
skew.ax.xaxis.grid(b=True,which='major',color='#FFA500',linestyle=':',linewidth=1.5)
plt.subplots_adjust(right=0.87)

# Set Title for SkewT image
plt.title('KVUM ', loc='left')
plt.title(tdata[4]+'/'+tdata[3]+'/'+tdata[5], loc='center')
plt.title(tdata[7]+' UTC', loc='right')

# Plot the data using normal plotting functions, in this case using
# log scaling in Y, as dictated by the typical meteorological plot
skew.plot(p, T, 'r')
skew.plot(p, Td, 'g')
skew.plot_barbs(p, u, v, xloc=1.1)

# Plot dry and moist adiabats and mixing ratio lines
#skew.plot_dry_adiabats(t0=np.arange(-80,200,10),linestyle='-',colors='#D2691E',alpha=0.5)
#skew.plot_moist_adiabats(p=np.linspace(1020,200,100),linestyle='-',colors='g',alpha=0.5)
#skew.plot_mixing_lines(colors='b',alpha=0.6)

skew.plot_dry_adiabats()
skew.plot_moist_adiabats()
skew.plot_mixing_lines()

# Create a hodograph
#ax_hod = inset_axes(skew.ax, '40%', '40%', loc=1)
#h = Hodograph(ax_hod, component_range=80.)
#h.add_grid(increment=20)
#h.plot_colormapped(u, v, sped)

plt.draw()
plt.savefig('/home/kgoebber/http/soundings/launches/'+launch+'_'+ascent+'/'+launch+'_'+ascent+'_KVUM.png',dpi=150)
#plt.show()
