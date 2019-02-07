#!/bin/csh



source /home/gempak/current/Gemenviron
#source /home/kgoebber/.bashrc
setenv PATH /anaconda/bin:$PATH

cd /home/kgoebber/http/upload

if (-e files_to_run.txt) then
  set folder =  `ls *.STD | cut -c 1-7`
  #set folder =  "090_001"

  foreach x ($folder)
    echo ${x}
    set launch = `echo ${x} | cut -c 1-3`
    set ascent = `echo ${x} | cut -c 5-7`
    # ssh kgoebber@fujita.valpo.edu /bin/mkdir /home/kgoebber/http/soundings/launches/${x}
    /bin/mkdir /home/kgoebber/http/soundings/launches/${x}
    #scp ${x}* kgoebber@fujita.valpo.edu:/home/kgoebber/http/soundings/launches/${x}/.
    #/bin/cp /archive/archivedata/data_kevin/KVUM_launches/${x}* /home/kgoebber/http/soundings/launches/${x}/.
    /bin/cp /home/kgoebber/http/upload/${x}* /home/kgoebber/http/soundings/launches/${x}/.
    /anaconda/bin/python skewt_new.py ${launch} ${ascent}
    #/home/kgoebber/http/upload/sounding.g ${x}
  end
  /bin/rm -f files_to_run.txt
  /bin/rm -f ${x}.*
  /bin/rm -f *.nts

else if (-e flightpath_to_run.txt) then
  set folder = `ls *_flight_path.txt | cut -c 1-7`
  /bin/cp ${folder}_flight_path.txt /home/kgoebber/http/soundings/launches/${folder}/flight_path.txt
  /bin/rm -f flightpath_to_run.txt
  /bin/rm -f ${folder}_flight_path.txt

else
  echo "Nothing to run at this time."

endif
