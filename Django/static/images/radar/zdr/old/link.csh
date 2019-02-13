#!/bin/csh


if (!(-e /home/kgoebber/http/radar_data/zdr/link_running.txt)) then
cd /home/kgoebber/http/radar_data/zdr
 touch link_running.txt

cd /archive/vuradar/imagegen

set COUNT = 1
set SOFT = `ls VAL2013*12160.png | grep VAL2 | tail -24l`
set NUMB = 24

cd /home/kgoebber/http/radar_data/zdr

rm zdr_img*.png

while ( $COUNT <= $NUMB )
  @ COUNT2 = $COUNT - 1
  cp /archive/vuradar/imagegen/$SOFT[$COUNT] zdr_img${COUNT2}.png
  @ COUNT = $COUNT + 1
end

rm link_running.txt

else
 echo "ALREADY RUNNING"

endif
