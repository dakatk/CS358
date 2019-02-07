<html>
<link rel="stylesheet" href="http://bergeron.valpo.edu/web_style.css">
<head>
<?php
import_request_variables('gp');
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
<body>
<div class="header"><img src="http://bergeron.valpo.edu/images/title1.png"><p>
  Welcome to the Valparaiso University Online Weather Center!  This page is currently under construction.
</div>
<ul class="navbar">
  <li><a href="http://bergeron.valpo.edu/">Home</a>
  <li><a href="http://www.valpo.edu/geomet/met/index.php">Departmental Page</a>
  <li><a href="http://bergeron.valpo.edu/forecast">Valpo Forecast</a>
  <li><a href="http://bergeron.valpo.edu/model">WRF Model</a>
  <li><a href="http://bergeron.valpo.edu/radar">KVAL Radar</a>
  <!--li><a href="vpz_radar.html">Radar</a>
  <li><a href="vpz_forecast.html">Forecasts</a>
  <li><a href="instruments.html">Instrumentation</a>
  <li><a href="vpz_sound.html">Soundings</a>
  <li><a href="school_mesonet.html">School Mesonets</a-->
</ul>
<ul class="navbar2">
<table class="text1" border="1" align=center style="border-style:solid" bgcolor="white" cellpadding=3>
 <font class=text1>
 <tr>
 <td class="compactLinks" align=center colspan=2>
 <strong>WRF</strong>
 </td></tr>
 <tr><td align=center>
  <a href="/model/wrf/mslp/temp" class="menuA">MSLP </a></td>
 <td align=center>
  <a href="/model/wrf/temp/850" class="menuA">850 hPa </br> Temp</a>
 </td></tr>
<tr> <td align=center>
  <a href="/model/wrf/mslp/dewp" class="menuA">Sfc </br> Dewp</a>
 </td>
 <td align=center>
  <a href="/model/wrf/temp/700" class="menuA">700 hPa </br> Temp</a>
 </td></tr>
<tr><td align=center>
  <a href="/model/wrf/precip/total" class="menuA">Precip</br></a>
 </td>
 <td align=center>
  <a href="/model/wrf/temp/500" class="menuA">500 hPa </br> Temp</a>
 </td></tr>
 <tr><td align=center>
  <a href="/model/wrf/wind/850" class="menuA">850 hPa </br> Winds</a>
 </td>
 <td align=center>
  <a href="/model/wrf/wind/300" class="menuA">300 hPa </br> Winds</a>
 </td></tr>
 <tr><td align=center>
  <a href="/model/wrf/wind/700" class="menuA">700 hPa </br> Winds</a>
 </td>
 <td align=center>
  <a href="/model/wrf/vort/700" class="menuA">700 hPa </br> Vort</a>
 </td></tr>
 <tr><td align=center>
  <a href="/model/wrf/wind/500" class="menuA">500 hPa </br> Winds</a>
 </td>
 <td align=center>
  <a href="/model/wrf/vort/500" class="menuA">500 hPa </br> Vort</a>
 </td></tr>
</table>
</ul>
</form>
<div class=image>
        <img src="" name="animation"></td>
</div>
<div class=model>
<font class=text1>
<?php
if ($a == null) {$a = "wrf"; }
if ($b == null) {$b = "mslp"; }
if ($c == null) {$c = "temp"; }

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
if ($q==null) $q = "temp";
if($model == "wrf") {$max = 25;}
elseif($model == "gfs") {$max = 21;}
elseif($model == "nam") {$max = 17;}
$t=1;

$menuSettings = array (
   "a" => array ("Select Model",2),
   "b" => array ("Product Type",2),
   "c" => array ("Level",2),
);

$crc = "http://bergeron.valpo.edu/model/WRF/d01_${b}_${c}_f";

?>

<!--form name="action" method="get">
          <input type="radio" name="m" value="gfs">GFS</input>
          <input type="radio" name="m" value="nam">NAM</input>
          <input disabled type="radio" name="m" value="ngm">NGM</input>
          <br><strong>Choose model Parameter</strong><br />
          <input type="radio" name="q" value="SFC">Surface</input>
</td><td>          <input type="radio" name="t" value="SFC">Surface</input>
</td><td>          <input type="radio" name="p" value="temp">Temperatures</input>
</td><td>          <input type="radio" name="p" value="vort">Vorticity</input>
</td><td>          <input type="radio" name="p" value="vert_vel">Vert Vel</input>
</td><td>          <input type="radio" name="p" value="temp_adv">Temp ADV</input>
</td><td>          <input type="radio" name="p" value="vort_adv">Vort ADV</input>
</td><td>          <input type="radio" name="p" value="rel_hum">Rel Hum</input>
</td><td>          <input type="radio" name="p" value="hght_tend">Hght Tendency</input>
</td><td>          <input type="radio" name="p" value="stream_vort">Vort with Stream</input>
</td></tr>
<tr><td>
          <input type="radio" name="p" value="mslp_temp">MSLP</input><br />
          <input type="radio" name="p" value="dewp">SFC Dewpoint</input><br />
          <input type="radio" name="p" value="300">300</input><br />
	  <input type="radio" name="p" value="500">500</input><br />
          <input type="radio" name="p" value="700">700</input><br />
          <input type="radio" name="p" value="850">850</input><br />
</td><td>
          <input type="radio" name="p" value="cape">CAPE</input><br />
          <input type="radio" name="p" value="hlcy">Helicity</input><br />
          <input type="radio" name="p" value="lift">Lifted Index</input><br />
          <input type="radio" name="p" value="pmsl">MSLP</input><br />
          <input type="radio" name="p" value="dewp">SFC Dewp</input><br />
          <input type="radio" name="p" value="850_500mb_thermal_wind">Thermal Wind</input><br />
          <input type="radio" name="p" value="DT_vort">DT with 850 Rel Vort</input><br />
</td><td>
	  <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
	  <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
          <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
          <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
          <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
          <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
          <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td><td>
          <input type="radio" name="t" value="500">500</input><br />
          <input type="radio" name="t" value="700">700</input><br />
          <input type="radio" name="t" value="850">850</input><br />
</td>
</tr></table-->
<br>
<br>
<!--input type=submit value="Go!"-->
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
</div>



<!--input type=checkbox name="nostep">Check this box to enable the links below to display the image you select<br--><br>
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
       if ($b == "temp") {
        $crc = "http://bergeron.valpo.edu/model/WRF/d01_${c}mb_${b}_f";
        echo "temp[$i] = \"$crc";
        #echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
          printf('%02.0f',$FH);
          echo ".png\";\n";
       }
       elseif ($b == "mslp" && $c == "temp") {
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
#       echo "temp[$i]= \"/~jyoung/images/models/ruc_${p}_${typ}_"; 
#        echo "temp[$i] = \"/model/WRF/${q}_${p}_${i}";
        $crc = "http://bergeron.valpo.edu/model/WRF/d01_${b}_f";
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


</font>
</div>
</div>
</body>
</html>
