#!/bin/csh

set folder =  `ls launches/*/*.STD | cut -c 18-24`

#set folder =  "091_001"

foreach x (${folder})
 echo ${x}
 set launch = `echo ${x} | cut -c 1-3`
 set ascent = `echo ${x} | cut -c 5-7`
 echo $launch
 echo $ascent
# # ssh kgoebber@fujita.valpo.edu /bin/mkdir /home/kgoebber/http/soundings/launches/${x}
# /bin/mkdir /home/kgoebber/http/soundings/launches/${x}
# #scp ${x}* kgoebber@fujita.valpo.edu:/home/kgoebber/http/soundings/launches/${x}/.
## /bin/cp /archive/archivedata/data_kevin/KVUM_launches/${x}* /home/kgoebber/http/soundings/launches/${x}/.
# /bin/cp /home/kgoebber/http/test/${x}* /home/kgoebber/http/soundings/launches/${x}/.

# python create_gem_data_VUM_soundings.py ${x}
 python skewt_new.py $launch $ascent
# /home/kgoebber/http/soundings/sounding.g ${x}
end
