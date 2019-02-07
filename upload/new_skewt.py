
#from matplotlib.axes import Axes
#from matplotlib.lines import Line2D
#from matplotlib.collections import LineCollection
#from matplotlib.ticker import FixedLocator, AutoLocator, ScalarFormatter
#import matplotlib.transforms as transforms
#import matplotlib.axis as maxis
#import matplotlib.artist as artist
#from matplotlib.projections import register_projection
import matplotlib
#matplotlib.use('Agg')
import numpy as np
import matplotlib.pyplot as plt
from metpy.plots.skewt import *

def var_read(type,p,tm,h,T,rh,Td,dir,sped):
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
           dir.append(dummy[6])
           sped.append(dummy[7])
    return(p,tm,h,T,rh,Td,dir,sped)

def read_imet(lid,ascent):
    import re
    #if (lid < 100):
    #   slid = "0"+str(lid)
    #else:
    #   slid = str(lid)
    slid = str(lid)
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
    dir  = []
    sped = []

    # Read Standard Level Data
    tdata = re.split('/|\s+|\r\n',std.readline())
    for i in range(19): #Skip next 19 lines
        std.readline()
    p,tm,h,T,rh,Td,dir,sped = var_read(std,p,tm,h,T,rh,Td,dir,sped)
    # Read Significant Level Data
    for i in range(22):
        sig.readline()
    p,tm,h,T,rh,Td,dir,sped = var_read(sig,p,tm,h,T,rh,Td,dir,sped)

    data = np.empty((len(p),4))
    data[:,0] = p
    data[:,1] = h
    data[:,2] = T
    data[:,3] = Td
    data=data[data[:,0].argsort()][::-1]

    return(data[:,0],data[:,1],data[:,2],data[:,3],tdata)


#p,h,T,Td = np.loadtxt(sound_data, usecols=range(0,4), unpack=True)
import sys

l = sys.argv[1]
a = sys.argv[2]

p,h,T,Td,tdata = read_imet(l,a)

fig = plt.figure(figsize=(6.5875, 6.2125))
skew = SkewT(fig)
skew.ax.yaxis.grid(b=True,which='major',color='k',linestyle='-')
skew.ax.xaxis.grid(b=True,which='major',color='#FFA500',linestyle='--')

plt.title('KVUM ', loc='left')
plt.title(tdata[4]+'/'+tdata[3]+'/'+tdata[5], loc='center')
plt.title(tdata[7]+' UTC', loc='right')

# Plot the data using normal plotting functions, in this case using
# log scaling in Y, as dictated by the typical meteorological plot
skew.plot(p, T, 'r')
skew.plot(p, Td, 'g')

# Example of coloring area between profiles
skew.ax.set_xlim(-40,45)
skew.ax.set_ylim(1020,100)
#skew.ax.fill_betweenx(p, T, 0, where=T>=0, facecolor='red', alpha=0.4)

# An example of a slanted line at constant T -- in this case the 0
# isotherm
#l = skew.ax.axvline(0, color='c', linestyle='--', linewidth=2)
skew.plot_dry_adiabats()
skew.plot_mixing_lines()
skew.plot_moist_adiabats()

plt.draw()
plt.savefig('/home/kgoebber/http/soundings/launches/'+l+'_'+a+'/'+l+'_'+a+'_KVUM.png',dpi=150)
#plt.show()
