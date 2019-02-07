#!/bin/python

import sys, os
import numpy as N

#launch = raw_input("Input launch number (3-digits): ")
#ascension = raw_input("Input the ascension number (2-digits): ")

filename = str(sys.argv)[38:45]

std_values = []
sig_values = []
dummy = []
dummy2 = []

#if len(launch) < 3:
#	if len(ascension) < 2:
#		print "Use three digit number for launch and two digit number for the ascension number."
#		exit()
#	else:
#		print "Use three digit number for launch."
#		exit()
#if len(launch) == 3:
#	if len(ascension) < 2:
#		print "Use digit number for the ascension number."
#		exit()
print len(filename)
print filename

if len(filename) != 7:
	print "Use 7 digit number for the folder name."
	exit()

#print "Launch number: "+launch
#print "Ascension number: "+ascension

#std_levels = launch+"_0"+ascension+".STD"
#sig_levels = launch+"_0"+ascension+".SIG"
#outfile    = launch+"_0"+ascension+".out"
std_levels = "/home/kgoebber/http/soundings/launches/"+filename+"/"+filename+".STD"
sig_levels = "/home/kgoebber/http/soundings/launches/"+filename+"/"+filename+".SIG"
outfile    = "/home/kgoebber/http/soundings/launches/"+filename+"/"+filename+".out"

print "These are the two files that the program is using: "+std_levels+", "+sig_levels
i=0
for line in open(std_levels):
	dummy.append(line)
for line in range(20,len(dummy)):
	ua = dummy[line].split()
	i = i + 1
	if ua == ['INVERSION']:
		#print "NO DATA",i
		stop = i-2+20
for line in range(20,stop):
	ua = dummy[line].split()
	std_values.append(ua)
#print std_values
std_values = N.array(std_values)
#print N.shape(std_values)


j=0
for line in open(sig_levels):
        dummy2.append(line)
for line in range(22,len(dummy2)):
        ua2 = dummy2[line].split()
        j = j + 1
        if ua2 == ['SIGNIFICANT', 'LEVELS', 'FOR', 'WIND']:
#                print "NO DATA",j
                stop2 = j-2+22
for line in range(22,stop2):
        ua2 = dummy2[line].split()
        sig_values.append(ua2)
#print sig_values
sig_values = N.array(sig_values)
#print N.shape(sig_values)

data = N.zeros(((N.shape(std_values)[0]+N.shape(sig_values)[0]),6))
#print N.shape(data)
#print N.shape(std_values)[0]
#print N.shape(sig_values)[0]
total=N.shape(data)[0]
data[0:N.shape(std_values)[0],0] = std_values[0:N.shape(std_values)[0],0]
data[0:N.shape(std_values)[0],1] = std_values[0:N.shape(std_values)[0],2]
data[0:N.shape(std_values)[0],2] = std_values[0:N.shape(std_values)[0],3]
data[0:N.shape(std_values)[0],3] = std_values[0:N.shape(std_values)[0],5]
data[0:N.shape(std_values)[0],4] = std_values[0:N.shape(std_values)[0],6]
data[0:N.shape(std_values)[0],5] = std_values[0:N.shape(std_values)[0],7]
data[N.shape(std_values)[0]:total,0] = sig_values[0:N.shape(sig_values)[0],0]
data[N.shape(std_values)[0]:total,1] = sig_values[0:N.shape(sig_values)[0],2]
data[N.shape(std_values)[0]:total,2] = sig_values[0:N.shape(sig_values)[0],3]
data[N.shape(std_values)[0]:total,3] = sig_values[0:N.shape(sig_values)[0],5]
data[N.shape(std_values)[0]:total,4] = sig_values[0:N.shape(sig_values)[0],6]
data[N.shape(std_values)[0]:total,5] = sig_values[0:N.shape(sig_values)[0],7]
#data=N.sort(data,0)[::-1]
data=data[data[:,0].argsort()][::-1]


year=str(dummy[0].split()[3].split('/')[2][2:4])
day=str(dummy[0].split()[3].split('/')[0])
month=str(dummy[0].split()[3].split('/')[1])

date = "%s%s%s" %(year,month,day)
print "Date: "+date

hour=dummy[0].split()[5].split(':')[0]
min=dummy[0].split()[5].split(':')[1]

if min >= 30:
	hour = int(hour) + 1
if hour > 10:
	hour = str(hour)
	time = "%s00" %(hour)
else:
	hour = str(hour)
	time = "0%s00" %(hour)
print "Time: "+time+" UTC"

output = open(outfile, 'w')
print >>output, ""
print >>output, " SNPARM = PRES;HGHT;TMPC;DWPC;DRCT;SKNT"
print >>output, ""
print >>output, " STID = VUM           STNM =    99999   TIME = %s/%s" %(date,time)
print >>output, " SLAT =  41.46     SLON =   -87.04   SELV =   250.0"
print >>output, " STIM =  %s" %(time)
print >>output, ""
print >>output, "      PRES     HGHT     TMPC     DWPC     DRCT     SKNT"
for i in range(0,total):
	print >>output, "%10.2f%9.2f%9.2f%9.2f%9.2f%9.2f" %(data[i,0],data[i,1],data[i,2],data[i,3],data[i,4],data[i,5])
output.close()
print "Created the output file "+outfile

# Create GEMPAK file from created text file.
print "Writing simple temporary shell script"
#outgem=launch+"_0"+ascension+".gem"
outgem="/home/kgoebber/http/soundings/launches/"+filename+"/"+filename+".gem"
scriptfile = "temp_gempak_script.g"
file = open(scriptfile, 'w')
print >>file, "#!/bin/csh"
print >>file, ""
print >>file, "snedit <<EOF"
print >>file, "SNEFIL= %s" %(outfile)
print >>file, "SNFILE= %s" %(outgem)
print >>file, "TIMSTN= 1/1"
print >>file, ""
print >>file, "run"
print >>file, ""
print >>file, "exit"
print >>file, ""
print >>file, "EOF"
print >>file, ""
file.close()

os.system("chmod u+x "+scriptfile)
os.system("rm "+outgem)
print "Running temporary script file"
os.system("./"+scriptfile)
print "Removing temproary script file"
os.system("rm "+scriptfile)
#os.system("rm *.nts")

#print "Created the GEMPAK file to be used with SNPROF."
