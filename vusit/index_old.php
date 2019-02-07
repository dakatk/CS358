<html>
<link rel="stylesheet" href="http://fujita.valpo.edu/web_style.css">
<head>

<script type="text/javascript">
<!--
var imax = 24, inc = 2, delay = 100, dwell = 1000, dinc = 100; 
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

temp[0] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_1.png";
temp[1] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_2.png";
temp[2] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_3.png";
temp[3] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_4.png";
temp[4] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_5.png";
temp[5] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_6.png";
temp[6] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_7.png";
temp[7] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_8.png";
temp[8] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_9.png";
temp[9] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_10.png";
temp[10] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_11.png";
temp[11] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_12.png";
temp[12] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_13.png";
temp[13] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_14.png";
temp[14] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_15.png";
temp[15] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_16.png";
temp[16] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_17.png";
temp[17] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_18.png";
temp[18] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_19.png";
temp[19] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_20.png";
temp[20] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_21.png";
temp[21] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_22.png";
temp[22] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_23.png";
temp[23] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_24.png";
temp[24] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_25.png";
temp[25] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_26.png";
temp[26] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_27.png";
temp[27] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_28.png";
temp[28] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_29.png";
temp[29] = "http://fujita.valpo.edu/~dgoines/vusit/images/VUSIT_location_30.png";



// actual loading is done here

images = new Array(imax);
for (var i = 0 ; i < imax; i++) {
 images[i]= new Image();
 images[i].onload=count_images;
 images[i].src=temp[i];
}

// reverse the order to get the oldest first and newest last
images.reverse();

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



<script language="JavaScript">
function readCookie(name){
return(document.cookie.match('(^|; )'+name+'=([^;]*)')||0)[2]
}
</script>
<?php
import_request_variables('gp');
#$pagename = 'KVAL Radar Images from Valparaiso, IN';
$pagename = 'VUSIT Chase Location';
#echo '<meta http-equiv="refresh" content="600" />';
echo '<title> Valparaiso University | '. $pagename. '</title>';
echo '<meta http-equiv="refresh" content="60">';
echo '</head>';
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
<body onScroll='document.cookie='ypos=' + window.pageYOffset' onLoad='window.scrollTo(0,readCookie('ypos'))'>
<div class="header"><img src="http://fujita.valpo.edu/images/title1.png"><p>
  Welcome to the Valparaiso University Online Weather Center!  This page is currently under construction.
</div>
<ul class="navbar">
  <li><a href="http://fujita.valpo.edu/">Home</a>
  <li><a href="http://www.valpo.edu/geomet/met/index.php">Departmental Page</a>
  <li><a href="http://fujita.valpo.edu/forecast">Valpo Forecast</a>
  <li><a href="http://fujita.valpo.edu/model">WRF Model</a>
  <li><a href="http://fujita.valpo.edu/ncep_models">GFS Model</a> 
  <li><a href="http://fujita.valpo.edu/radar">KLOT Radar</a>
  <li><a href="http://fujita.valpo.edu/soundings">KVUM Launches</a>
</ul>


<div class=model>
<font class=text1>

<br>
<br>
<!--input type=submit value="Go!"-->
</form>
<br><br>
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
	  <td rowspan=2 align="center" width=250><font class=text1>
            <b>Frame</b>
            <input value="" name="frame" size="10" type="text" class="maptext"></font>
	  </td>
	  <td align=right width=275><font class="text1"> <strong>Speed: </strong>  
            <input value="&lt;&lt;" onclick="delay=delay*inc; show_delay();" name="button2" type="button">
            <input value="&gt;&gt;" onclick="delay=delay/inc; show_delay();" name="button2" type="button"></font>
	  </td>
	  <td><font class=text1>
	   <input value="" name="dly" size="10" type="text" class="maptext"></font> 
	  </td>
	</tr>
    </table>
<br>
<!--input type=checkbox name="nostep">Check this box to enable the links below to display the image you select<br--><br>
<div class="radar" style="width:1000px;overflow:auto;">
        <img src="" name="animation"></td>
</div>
 
<!--  Delay (ms): <INPUT TYPE=text VALUE="" NAME="delay" SIZE=6> //-->
</form>
&nbsp;


<br>
<!--input type=checkbox name="nostep">Check this box to enable the links below to display the image you select<br--><br>
<?php
#for ($i = 0; $i < $max; $i++) {
#$newi = $i+1;
#    echo "<a href=\"javascript:step($i)\" onMouseOver=\"step($i)\">$newi</a> | \n";
//};
?>
<div class="radar" style="width:1000px;overflow:auto;">
        <img src="" name="animation"></td>
</div>
 
<!--  Delay (ms): <INPUT TYPE=text VALUE="" NAME="delay" SIZE=6> //-->
</form>
&nbsp;
<script type="text/javascript">
<!--
var imax = <?php echo $max; ?>, inc = 2, delay = 100, dwell = 1000, dinc = 100; 
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
$j=0;
$k=0;
$l=0;
for ($i = 0; $i < $total; $i++) {
  $string = "http://www.nco.ncep.noaa.gov/pmb/nwprod/analysis/namer/$model/$ftime/images/${model}_${typ}_$fhr$siz.gif";
 if ($model == "radar") {
  if ($b == "ref") {
    if (file_exists("../radar_data/reflectivity/${b}_img${i}.png")) {
     echo "temp[$j] = \"http://fujita.valpo.edu/radar_data/reflectivity/${b}_img$i";
     echo ".png\";\n";
     $j++;
    }
  }
  elseif ($b == "vel") {
    if (file_exists("../radar_data/velocity/${b}_img${i}.png")) {
     echo "temp[$k] = \"http://fujita.valpo.edu/radar_data/velocity/${b}_img$i";
     echo ".png\";\n";
     $k++;
    }
  }
  elseif ($b == "zdr") {
    if (file_exists("../radar_data/zdr/${b}_img${i}.png")) {
     echo "temp[$l] = \"http://fujita.valpo.edu/radar_data/zdr/${b}_img$i";
     echo ".png\";\n";
     $l++;
    }
  }
  else {echo "temp[$i]= \"$string\";\n";}
 };
};
?>

// actual loading is done here

images = new Array(imax);
for (var i = 0 ; i < imax; i++) {
 images[i]= new Image();
 images[i].onload=count_images;
 images[i].src=temp[i];
}

// reverse the order to get the oldest first and newest last
images.reverse();

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
