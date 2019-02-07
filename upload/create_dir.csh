#!/bin/csh



source /home/gempak/current/Gemenviron
#source /home/kgoebber/.bashrc
setenv PATH /anaconda/bin:$PATH

cd /var/www/html/upload

if (-e files_to_run.txt) then
  set folder =  `ls *STD* | cut -c 1-11`
  #set folder =  "090_001"

  foreach x ($folder)
    echo ${x}
    set launch = `echo ${x} | cut -c 1-8`
    set ascent = `echo ${x} | cut -c 10-11`
    # ssh kgoebber@fujita.valpo.edu /bin/mkdir /var/www/html/soundings/launches/${x}
    /bin/mkdir /var/www/html/soundings/launches/${x}
    chgrp webadmin /var/www/html/soundings/launches/${x}
    #scp ${x}* kgoebber@fujita.valpo.edu:/var/www/html/soundings/launches/${x}/.
    #/bin/cp /archive/archivedata/data_kevin/KVUM_launches/${x}* /var/www/html/soundings/launches/${x}/.
    /bin/mv /var/www/html/upload/${x}* /var/www/html/soundings/launches/${x}/.
    /anaconda/bin/python /var/www/html/soundings/skewt_new.py ${launch} ${ascent}
    #/var/www/html/upload/sounding.g ${x}
  end
  /bin/rm -f files_to_run.txt
  /bin/rm -f ${x}.*
  /bin/rm -f *.nts

else if (-e flightpath_to_run.txt) then
  set folder = `ls *_flight_path.txt | cut -c 1-11`
  /bin/cp ${folder}_flight_path.txt /var/www/html/soundings/launches/${folder}/flight_path.txt
  /bin/rm -f flightpath_to_run.txt
  /bin/rm -f ${folder}_flight_path.txt

else
  echo "Nothing to run at this time."

endif
