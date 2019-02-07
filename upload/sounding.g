#!/bin/csh

set launch = $1

snprof << EOF
 SNFILE   = /home/kgoebber/http/soundings/launches/${launch}/${launch}.gem
 DATTIM   = last
 AREA     = @VUM
 SNPARM   = TMPC;brbk
 LINE     = 2/1/5
 PTYPE    = skew
 VCOORD   = PRES
 STNDEX   =
 STNCOL   = 1
 WIND     = bk1
 WINPOS   = 1
 MARKER   = 0
 BORDER   = 1
 TITLE    = 1/0/TMPC DWPC
 DEVICE   = psc| /home/kgoebber/http/soundings/launches/${launch}/${launch}_KVUM.ps | 8;10
 YAXIS    = ///1;1
 XAXIS    = -30/40/10/1;1
 FILTER   = YES
 CLEAR    = YES
 PANEL    = 0
 TEXT     = 1.5/2/2
 THTALN   = 8
 THTELN   = 21/10
 THTELN   = 21
 MIXRLN   = 5/2
 MIXRLN   = 4/2

run

 SNPARM  = DWPC
 LINE    = 3/2/5
 CLEAR   = NO
 TITLE   =

run

exit

EOF

gpend

/usr/bin/convert -rotate 90 -background white -flatten /home/kgoebber/http/soundings/launches/${launch}/${launch}_KVUM.ps /home/kgoebber/http/soundings/launches/${launch}/${launch}_KVUM.png
