<html>
<head>

<?php
$pagename = 'Forecasts - WRF Simulation Model Data';
$id = "forecast";
#$fp=fopen('header.txt','r');
#$content=fread($fp,filesize('header.txt'));
#fclose($fp);
#$fc=fopen('footer.php','r');
#$footer=fread($fc,filesize('footer.php'));
#fclose($fc);
#$content = $content;
echo '</head>';
#echo '<link href="stylesheet.css" rel="stylesheet" type="text/css">';
#echo '<div class="pagename"> <img src="null" width="50" height="1">';
echo '<title> Valparaiso University | '. $pagename. '</title></div>';
#echo $content. $pagename;
#virtual("menu2.php");
$hour = date(H);
$dst = date(I);
if ($dst = 1) {
// it is DST
  $utc = $hour + 5;
} else {
// it is not DST
 $utc = $hour + 6;
};
if ($utc > 23 )  $utc = $utc - 24;
// define the 0,6,12,18 times
if ($utc > 0 && $utc < 7) { $ftime = "18"; }
else if ($utc > 6 && $utc < 13) { $ftime = "0"; }
else if ($utc > 12 && $utc < 19) { $ftime = "6"; }
else { $ftime = "12"; };
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Valparaiso University Weather Center</title>
<style type="text/css">
body{font:100%/1.6 Verdana,Arial,Helvetica,sans-serif;background:#381e0e;margin:0;padding:0;color:#000}
ul,ol,dl{padding:0;margin:0}
h1,h2,h3,h4,h5,h6,p{margin-top:0;padding-right:0px;padding-left:0px}
a img{border:none}
a {color:white; text-decoration:none;}
a:link{color:#381e0e;text-decoration:None}
a:visited{color:#381e0e;text-decoration:None}
a:hover,a:active,a:focus{text-decoration:None;font-weight: bold;}
.container{width:1250;background:#381e0e;margin:0 auto;}
.header{padding:0px 0px 10px 0px;background:#381e0e;width:1240px}
.sidebar1{padding:0px 0px 0px 0px;float:left;width:230px;background:#381e0e;padding-bottom:50px}
.sidebar2{padding:0px 0px 0px 0px;float:left;width:230px;background:#381e0e;padding-bottom:50px}
.content{padding:0px 10px 0px 10px;width:1000px;float:left;background:#381e0e}
.content ul,.content ol{padding:5px 5px 5px 5px}
ul.nav{moz-border-radius: 15px;-webkit-border-radius: 15px;list-style:none;border-top:0px solid #666;margin-bottom:15px}
ul.nav li{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:0px 0px 5px 0px;border-bottom:0px solid #666}
ul.nav a,ul.nav a:visited{moz-border-radius: 15px;color:#381e0e;-webkit-border-radius: 15px;padding:4px 0px 4px 15px; display:block; width:215px; text-decoration:None; background:#c8b18b}
ul.nav a:hover,ul.nav a:active,ul.nav a:focus{background:#613318;color:#ffcc00;text-decoration:None}
.footer{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:5px 10px 5px 10px; width:980px; background:#c8b18b; position:relative; clear:both}
.fltrt{float:right;margin-left:8px}
.fltlft{float:left;margin-right:8px}
.clearfloat{clear:both;height:0;font-size:1px;line-height:0px}

#child, #child2, #child3, #child4{position:absolute; display:none; top:200px; z-index:9; color:red;}
#child:target, #child2:target, #child3:target, #child4:target {display:block;}
td a {display:block; background:#c8b18b; color: #381e0e; width:100%; height:100%; border-radius:20px;}
td a:hover {background:#613318; color:#ffcc00; border-radius:20px;}
td.current {display:block; color: #ffffff; width:100%; height:100%;}
</style>
</head>


<body>

<div class="container">
  <div class="header">
    <table width=1240>
    <td width=240 valign=center align=center>
    <img src="http://bergeron.valpo.edu/images/valpo_logo.png" alt="Picture" name="Insert_logo" width="170" id="Insert_logo" align="bottom"></a>
    </td>
    <td valign="center" align="center" width=1035 style="moz-border-radius: 15px;-webkit-border-radius: 15px;background: url('http://bergeron.valpo.edu/images/header.png') no-repeat;background-size:1035px;">
    <font size=6 color=#ffffff><b>&nbspDepartment of Geography and Meteorology<br>&nbspOnline Weather Center</b></font>
    </td>
    </table>
  </div>
  <div class="sidebar1">
    <ul class="nav"><center>
      <li><a href="http://bergeron.valpo.edu" align=center><font size=4>Home</font></a></li>
      <li><a href="http://bergeron.valpo.edu/current" align=center><font size=4>Current Conditions</font></a></li>
      <li><a href="http://bergeron.valpo.edu/mesonet" align=center><font size=4>NWI Mesonet</font></a></li>
      <li><a href="http://bergeron.valpo.edu/forecast" align=center><font size=4>Valpo Forecast</font></a></li>
      <li><a href="http://bergeron.valpo.edu/radar" align=center><font size=4>Valpo Radar</font></a></li>
      <li><a href="http://bergeron.valpo.edu/satellite" align=center><font size=4>Regional Satellite</font></a></li>
      <li><a href="http://bergeron.valpo.edu/soundings" align=center><font size=4>KVUM Sounding</font></a></li>
      <li><a href="http://bergeron.valpo.edu/model" align=center><font size=4 color=#ffcc00><b>WRF Model</b></font></a></li>
      <li><a href="http://bergeron.valpo.edu/ncep_models" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/station_climo" align=center><font size=4>Sfc Station Climo</font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font size=4>Department Page</font></a></li>
<!--
      <li><a href="http://bergeron.valpo.edu/facstaff" align=center><font size=4>Department Faculty/Staff</font></a></li>
      <li><a href="http://bergeron.valpo.edu/misc" align=center><font size=4>Miscellaneous</font></a></li>
-->
      <br>
      <li><a href="/model/wrf/mslp/tmpf" class="menuA">MSLP </a></td></li>
      <li><a href="/model/wrf/tmpc/850" class="menuA">850 hPa Temp</a></li>
      <li><a href="/model/wrf/3h_acc_precip/total" class="menuA">3h Acc Precip</a></li>
      <li><a href="/model/wrf/tmpc/700" class="menuA">700 hPa Temp</a></li>
      <li><a href="/model/wrf/precip/total" class="menuA">Precip</a></li>
      <li><a href="/model/wrf/tmpc/500" class="menuA">500 hPa Temp</a></li>
      <li><a href="/model/wrf/wspd/850" class="menuA">850 hPa Winds</a></li>
      <li><a href="/model/wrf/wspd/300" class="menuA">300 hPa Winds</a></li>
      <li><a href="/model/wrf/wspd/700" class="menuA">700 hPa Winds</a></li>
      <li><a href="/model/wrf/avor/700" class="menuA">700 hPa Abs Vort</a></li>
      <li><a href="/model/wrf/wspd/500" class="menuA">500 hPa Winds</a></li>
      <li><a href="/model/wrf/avor/500" class="menuA">500 hPa Abs Vort</a></li>
      <li><a href="/model/wrf/cape/total" class="menuA">CAPE</a></li>
      <li><a href="/model/wrf/dbz/total" class="menuA">Sim. dBZ</a></li>
      </center>
    </ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

<table>
<!--td align=center width=150 bgcolor="#00FF00"><a href="http://bergeron.valpo.edu/model/US"> CONUS <br> Domain</a></td>
<td align=center width=150 bgcolor="#00FF00"><a href="http://bergeron.valpo.edu/model/HiRES"> 4km Valpo <br> Domain</a></td-->
</table>
</ul>
</form>

<div class="content">
<table width=1000 border=0 class="shortterm" align=center style="background-color: #c8b18b; border-radius:20px;">
  <tr>
    <td align=center valign=top>
<form name="form">
     <table border=0 width=900>
        <tr>
          <td width=175 align=center><font class=text1>
            <input value="Start" onclick="start_play();" name="button3" type="button" class="mapbutton">
            <input value="Stop" onclick="stop_play();" name="button" type="button" class="mapbutton">
            </font>
          </td>
          <td width=200 align="center"><font class=text1><strong>Direction</strong>
            <input value="" onclick="reverse();" name="direction" type="button" class="mapbutton2">
          </td>
          <td rowspan=2 width=200 align="center"><font class=text1><strong>Step</strong>
            <input value=" &lt; " onclick="backstep();" name="button2" type="button" class="mapbutton2">
            <input value=" &gt; " onclick="forwardstep();" name="button2" type="button" class="mapbutton2"></font>
          </td>
          <td rowspan=2 align="center" width=200><font class=text1>
            <b>Frame</b>
            <input value="" name="frame" size="10" type="text" class="maptext"></font>
          </td>
          <td align=center width=250><font class="text1"> <strong>Speed: </strong>
            <input value="&lt;&lt;" onclick="delay=delay*inc; show_delay();" name="button2" type="button">
            <input value="&gt;&gt;" onclick="delay=delay/inc; show_delay();" name="button2" type="button"></font>
          </td>
          <td align=left width=150><font class=text1>
           <input value="" name="dly" size="10" type="text" class="maptext"></font>
          </td>
        </tr>
    </table>
</form>

<div class=model>
</div>
<div class=image>
<img src="" name="animation"></td>
</div>

<font class=text1>
<?php
$a = $_GET["a"];
$b = $_GET["b"];
$c = $_GET["c"];
if ($a == null) {$a = "wrf"; }
if ($b == null) {$b = "mslp"; }
if ($c == null) {$c = "tmpf"; }
// GET the information about which model to show, and what hours
$max = $_GET["r"];
$typ = $_GET["q"];
$siz = $_GET["s"];
$model = $_GET["m"];
if ($max == null) $max = 25;
if ($typ == null) $typ = 500;
if ($siz == null) $siz = m;
if ($model == null) $model = wrf;
if ($p==null) $p = "mslp";
if ($q==null) $q = "tmpc";
if($model == "wrf") {$max = 25;}
elseif($model == "gfs") {$max = 21;}
elseif($model == "nam") {$max = 17;}
$t=1;

$menuSettings = array (
   "a" => array ("Select Model",2),
   "b" => array ("Product Type",2),
   "c" => array ("Level",2),
);

$crc = "http://bergeron.valpo.edu/model/WRF/sfc_${b}_${c}_wind_f0";

?>

<?php
#for ($i = 0; $i < $max; $i++) {
#$newi = $i+1;
#    echo "<a href=\"javascript:step($i)\" onMouseOver=\"step($i)\">$newi</a> | \n";
//};
?>
<div style="width:1000px;overflow:auto;">
</div>

<!--  Delay (ms): <INPUT TYPE=text VALUE="" NAME="delay" SIZE=6> //-->
&nbsp;
<script type="text/javascript">
<!--
var imax = <?php echo $max; ?>, inc = 2, delay = 500, dwell=1000, dinc=1000;
var num_loaded_images = 0;
var frame=-1;
var timeout_id=null;
var dir=-1, playing=0;
var run = 0;
var bname = "Reverse";

// function to count images as they are loaded into cache
function count_images() 
{ 
 if (++num_loaded_images == imax) {
  clipimage();
  animate(); 
  show_delay();
  reverse();
 }  else {
  document.animation.src=images[num_loaded_images-1].src;
  document.form.frame.value=num_loaded_images+" of "+imax; 
 }
}

temp = new Array(imax);          

<?php
for ($i = 0; $i < $max; $i++) {
   if ($model == "ruc" && $i == 0) {
      $fhr = 00;
      $FH = 00;
      if ($FH < 10) {
        $FH = "0".$FH;
      }
      $date = 20070619;
   }
   if ($model == "ruc" && $i > 0) {
      $fhr = 00;
      $FH = $FH + 3;
      if ($FH < 10) {
          $FH = "0".$FH;
      }
      if ($FH == 24){
          $FH = "00";
          $date = $date + 1;
         if ($date == 20070631) {
             $date = 20070701;
         }
      }
    }
   if ($model == "wrf" && $i > 0) {
      $fhr = 0;
      $fhr = $fhr + 1;
      $FH = $FH + 3;
      if ($FH < 10) {
          $FH = "0".$FH;
      }
     # if ($FH == 24){
     #     $FH = "00";
     #     $date = $date + 1;
     #    if ($date == 20070631) {
     #        $date = 20070701;
     #    }
     # }
    }
#  if ($model == "ruc" && $i < 7) {
#    $fhr =  $i;
#  } else if($model == "ruc" && $i < 9) {
#    $fhr = 3 * $i - 12;
#  } else if ($model == "nam") {
#    $fhr = 3 * $i;
#  } else if($model == "gfs" || $model == "ngm") {
#      $fhr = 6 * $i;
#      if ($model == "gfs" && $i > 30) $fhr = 12 * $i - 180;
#  } else $fhr = 6 * $i; 
  $fhrb = $fhr;
#  if ($fhr < 10) { 
#     $fhr = "00".$fhr;
#  }
#  else if ($fhr < 100) $fhr = "0".$fhr;
#  else $fhr = $fhr;
  $string = "http://www.nco.ncep.noaa.gov/pmb/nwprod/analysis/namer/$model/$ftime/images/${model}_${typ}_$fhr$siz.gif";

  if ($model == "gfs" || $model == "nam") {
    echo "temp[$i] = \"/${model}_${date}_${FH}/${model}_${typ}mb_${p}";
    if ($model == "gfs") { printf('%03.0f',$fhr); }
       else { printf('%02.0f',$fhr); }
    echo ".gif\";\n";
  }
  elseif ($model == "wrf") {
       if ($b == "tmpc") {
        $crc = "http://bergeron.valpo.edu/model/WRF/hght_${c}_${b}_f0";
        echo "temp[$i] = \"$crc";
        #echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
          printf('%02.0f',$FH);
          echo ".png\";\n";
       }
       elseif ($b == "wspd") {
        $crc = "http://bergeron.valpo.edu/model/WRF/hght_${c}_${b}_f0";
        echo "temp[$i] = \"$crc";
        #echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
          printf('%02.0f',$FH);
          echo ".png\";\n";
       }
       elseif ($b == "avor") {
        $crc = "http://bergeron.valpo.edu/model/WRF/hght_${c}_${b}_f0";
        echo "temp[$i] = \"$crc";
        #echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
          printf('%02.0f',$FH);
          echo ".png\";\n";
       }
       elseif ($b == "mslp" && $c == "tmpf") {
#       echo "temp[$i]= \"/~jyoung/images/models/ruc_${p}_${typ}_"; 
#        echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
        #$crc = "http://bergeron.valpo.edu/model/WRF/${b}_";
        echo "temp[$i] = \"$crc";
        printf('%02.0f',$FH);
        echo ".png\";\n";
       }
       elseif ($b == "mslp" && $c == "dewp") {
#       echo "temp[$i]= \"/~jyoung/images/models/ruc_${p}_${typ}_"; 
#        echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
        #$crc = "http://bergeron.valpo.edu/model/WRF/${b}_";
        $crc = "http://bergeron.valpo.edu/model/WRF/d01_${c}_f";
        echo "temp[$i] = \"$crc";
        printf('%02.0f',$FH);
        echo ".png\";\n";
       }
       elseif ($b == "precip") {
        $crc = "http://bergeron.valpo.edu/model/WRF/sfc_mslp_${b}_f0";
        echo "temp[$i] = \"$crc";
        printf('%02.0f',$FH);
        echo ".png\";\n";
       }
       elseif ($b == "3h_acc_precip") {
        $crc = "http://bergeron.valpo.edu/model/WRF/sfc_mslp_${b}_f0";
        echo "temp[$i] = \"$crc";
        printf('%02.0f',$FH);
        echo ".png\";\n";
       }
       elseif ($b == "cape") {
        $crc = "http://bergeron.valpo.edu/model/WRF/sfc_${b}_cin_f0";
        echo "temp[$i] = \"$crc";
        printf('%02.0f',$FH);
        echo ".png\";\n";
       }
       elseif ($b == "dbz") {
        $crc = "http://bergeron.valpo.edu/model/WRF/${b}_f0";
        echo "temp[$i] = \"$crc";
        printf('%02.0f',$FH);
        echo ".png\";\n";
       }
  }
  else {echo "temp[$i]= \"$string\";\n";}
};
?>
// actual loading is done here

images = new Array(imax);
for (var i = 0 ; i < imax; i++) {
 images[i]= new Image();
 images[i].onload=count_images;
 images[i].src=temp[i];
}

//function to clip the image
function clipimage() {
document.animation.style.clip="rect(0px,800px,0px,0px)";
}

// function to start movie

function start_play() {
 if (playing == 0) {
  if (timeout_id == null && num_loaded_images==imax) animate();
 }
} 

// function to stop movie

function stop_play() {
 if (timeout_id) clearTimeout(timeout_id); 
  timeout_id=null;
  playing = 0;
}

function incDwell()
{
        dwell = dwell + dinc;
}

function decDwell()
{
        if (dwell > 0) {dwell = dwell - dinc; } 
}

// function to do the animation when all images are loaded

function animate()
{
 var j;
 frame=(frame+dir+imax)%imax;
 j=frame+1;
 if (j == window.imax || j == 1) {controlDelay = dwell;} else {controlDelay = delay; }
 document.animation.src=images[frame].src;
 document.form.frame.value=j+" of "+imax;
 timeout_id=setTimeout("animate()",controlDelay);
 playing=1;
}


// function to control stepping thru each frame

function step(frm)
{
 var j;
 if (frm == null) {

    if (timeout_id) clearTimeout(timeout_id); timeout_id=null;
    frame=(frame+dir+imax)%imax;
    j=frame+1;
    document.animation.src=images[frame].src;
    document.form.frame.value=j+" of "+imax;

 } else if (document.form.nostep.checked){

    if (timeout_id) clearTimeout(timeout_id); timeout_id=null;
    frame=frm;
    j=frm+1;
    document.animation.src=images[frm].src;
    document.form.frame.value=j+" of "+imax;
 }
 playing=0;
}
function forwardstep()
{
 var j;
 if (timeout_id) clearTimeout(timeout_id); timeout_id=null;
 frame=(frame+dir+imax)%imax;
 j=frame+1;
 document.animation.src=images[frame].src;
 document.form.frame.value=j+" of "+imax;
 playing=0;
}
function backstep()
{
 var j;
 if (timeout_id) clearTimeout(timeout_id); timeout_id=null;
 frame=(frame-dir+imax)%imax;
 j=frame+1;
 document.animation.src=images[frame].src;
 document.form.frame.value=j+" of "+imax;
 playing=0;
}

// function to control direction of animation

function reverse()
{
 dir=-dir;
 if (dir > 0) document.form.direction.value="Reverse"; bname="Reverse";
 if (dir < 0) document.form.direction.value="Forward"; bname="Forward";
}

// function to display delay between frames (not implemented yet)

function show_delay()
{
var dely;
dely  = 1/(delay/1000);
dely = Math.round(dely*10)/10;
document.form.dly.value=dely+"img/sec";
}

// -->
</script>

    </td>
  </tr>
</table>

<br>
</body>

<br>

<div class="footer">
<table width=920 align=center>
  <tr>
    <td width=230 valign="top" align="center">
      <font size=3 color=#381e0e><b><u>Department Address</u></b></font><br>
      <font size=2>
      <a href="https://www.google.com/maps/place/Kallay-Christopher+Hall,+Valparaiso,+IN+46383/@41.4641356,-87.0393358,353m/data=!3m2!1e3!4b1!4m7!1m4!3m3!1s0x88119a407e1c9c13:0xb141031410a34636!2s1809+Chapel+Dr,+Valparaiso,+IN+46383!3b1!3m1!1s0x88119a3f42448c2b:0xbdc58d9760a66fab" target="_blank">Kallay-Christopher Hall<br>1809 Chapel Drive<br>Valparaiso, IN 46383</a>
      </font>
    </td>
    <td width=230 valign="top" align="center">
      <font size=3 color=#381e0e><b><u>University</u></b></font>
      <font size=2>
      <a href="http://www.valpo.edu/about/">About</a href>
      <a href="http://www.valpo.edu/studentlife/">Student Life</a href>
      <a href="http://www.valpo.edu/admission/">Admissions</a href>
      <a href="http://valpoathletics.com/">Athletics</a href>
      <a href="http://www.valpo.edu/vuca/">The Arts</a href>
      <a href="http://www.valpo.edu/alumni/">Valpo Alumni</a href>
      </font>
    </td>
    <td width=230 valign="top" align="center">
      <font  size=3 color=#381e0e><b><u>Academics</u></b></font>
      <font size=2>
      <a href="http://www.valpo.edu/cas/">College of Arts & Sciences</a href>
      <a href="http://www.valpo.edu/cob/">College of Business</a href>
      <a href="http://www.valpo.edu/engineering/">College of Engineering</a href>
      <a href="http://www.valpo.edu/nursing/">College of Nursing & Health</a href>
      <a href="http://www.valpo.edu/christcollege/">The Honors College</a href>
      <a href="http://www.valpo.edu/grad/">Graduate School</a href>
      <a href="http://www.valpo.edu/law/">Law School</a href>
      </font>
    </td>
    <td  width=230 valign="top" align="center">
      <font  size=3 color=#381e0e><b><u>Campus Resources</u></b></font>
      <font size=2>
      <a href="http://www.valpo.edu/directory/index.php">People/Offices</a href>
      <a href="http://www.valpo.edu/about/maps-directions/">Maps/Directions</a href>
      <a href="http://library.valpo.edu/">Library</a href>
      <a href="http://www.valpo.edu/chapel/">Chapel</a href>
      <a href="https://valpocareers.silkroad.com/">Employment</a href>
      <a href="http://blogs.valpo.edu/alert/">Campus Alerts</a href>
      </font>
    </td>
  </tr>
</table>
<!-- end .footer --></div>
<!-- end .content --></div>
<!-- end .container --></div>

</body>
</html>

