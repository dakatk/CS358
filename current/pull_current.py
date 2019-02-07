#!/anaconda/bin/python

# Imports
import sys, re, warnings

from datetime import datetime
from enum import Enum

import matplotlib
from urllib.request import urlretrieve

import numpy as np
import scipy.integrate as si

from metpy.calc.thermo import dewpoint_rh
from metpy.package_tools import Exporter
from metpy.constants import epsilon, kappa, P0, Rd, Lv, Cp_d
from metpy.units import atleast_1d, concatenate, units

# Initialize matplotlib and warnings settings
matplotlib.use('Agg')
warnings.filterwarnings("ignore")

# Enum for symbol constants
class Symbol(Enum):
    DEG = u'{0}'.format(u'\N{DEGREE SIGN}').encode('utf-8')
    UP_ARROW = u'{0}'.format(u'\u25b2').encode('utf-8')
    DOWN_ARROW = u'{0}'.format(u'\u25bc').encode('utf-8')
    RIGHT_ARROW = u'{0}'.format(u'\u25b6').encode('utf-8')

# User Input area
url = 'http://152.228.140.57/status.xml'
filename = 'status.txt' # "/var/www/html/current/status.txt"

# Inches per mb ratio
inch_mb_ratio = 1013.25 / 29.92

# Retrieve file from URL
urlretrieve(url, filename=filename)

# Retrieve text data from file
with open(filename, 'r') as f:
    for i, _ in enumerate(f):
        pass
    
    assert i > 0
    text_list = f.readlines()[1].split()

my_data = dict()

def check_tmp3(value_name):
    global my_data
    assert not my_data['tmp3'] is None
    
    tmp3 = float(my_data['tmp3'])
    return float(my_data[value_name]) == round(tmp3, 0)

for text in text_list:
    new_text_list = re.split('</|<|>', text)
    
    named_index = new_text_list[1]
    my_data[named_index] = new_text_list[2]


twi_pres_mb = float(my_data['baropres']) * inch_mb_ratio
twi_datetime = "%s %s" % (my_data['date'], my_data['time'])

# Write out update timestamp and temperature data
twi_file = open("twi_current.txt", "w")
twi_file.write("Updated: %s\n" % twi_datetime)
twi_file.write("Temperature: %s%sF\n" % (my_data['tmp3'], Symbol.DEG))

# Write out windchill and heat-index data
if check_tmp3('windchill'):
    twi_file.write("Head Index: %s%sF\n" % (my_data['heatindx'], Symbol.DEG))
    
elif check_tmp3('heatindx'):
    twi_file.write("Wind Chill: %s%sF\n" % (my_data['windchill'], Symbol.DEG))
    
else:
    twi_file.write("Head Index: %s%sF\n" % (my_data['heatindx'], Symbol.DEG))
    twi_file.write("Wind Chill: %s%sF\n" % (my_data['windchill'], Symbol.DEG))

# Write out dew point, humidity, and wind data
twi_file.write("Dew Point: %s%sF\n" % (my_data['dewpt'], Symbol.DEG))
twi_file.write("Humidity: %s%s%%\n" % my_data['rh'])
twi_file.write("Wind: %s @ %s mph\n" % (my_data['winddirtxt'], my_data['dindspd']))

# twi_file.write("Wind: "+my_data['winddirnum']+degree_symbol+" @ "+my_data['windspd']+" mph\n")

# Steady (initially)
press_tend_arrow = Symbol.RIGHT_ARROW

# Rising
if my_data['baropresdir'] == "R":
    press_tend_arrow = Symbol.UP_ARROW

# Falling
elif my_data['baropresdir'] == "F":
    press_tend_arrow = Symbol.DOWN_ARROW

# Write out pressure and solar data
twi_file.write("Pressure: %s mb %s\n" % (twi_pres_mb, press_tend_arrow))
twi_file.write("Solar: %s K\n" % my_data['tmp1'])
twi_file.close()
