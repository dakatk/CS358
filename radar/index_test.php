<html>
<link rel="stylesheet" href="http://bergeron.valpo.edu/web_style.css">
<head>
<script language="JavaScript">
function readCookie(name){
return(document.cookie.match('(^|; )'+name+'=([^;]*)')||0)[2]
}
</script>
<?php
#$pagename = 'KVAL Radar Images from Valparaiso, IN';
$pagename = 'KVAL Radar Images from Valparaiso, IN';
#echo '<meta http-equiv="refresh" content="600" />';
echo '<title> Valparaiso University | '. $pagename. '</title>';
echo '<meta http-equiv="refresh" content="600">';
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
<div class="header"><img src="http://bergeron.valpo.edu/images/title1.png"><p>
</div>
<ul class="navbar">
  <li><a href="http://bergeron.valpo.edu/">Home</a>
  <li><a href="http://www.valpo.edu/geomet/met/index.php">Departmental Page</a>
  <li><a href="http://bergeron.valpo.edu/forecast">Valpo Forecast</a>
  <li><a href="http://bergeron.valpo.edu/model">WRF Model</a>
  <li><a href="http://bergeron.valpo.edu/ncep_models">GFS Model</a> 
  <li><a href="http://bergeron.valpo.edu/radar">KVAL Radar</a>
  <li><a href="http://bergeron.valpo.edu/satellite">Regional Satellite</a>
  <li><a href="http://bergeron.valpo.edu/soundings">KVUM Launches</a>
  <li><a href="http://bergeron.valpo.edu/station_climo">SFC STN Climo</a>
</ul>
<ul class="navbar3">
<table class="text1" border="1" align=center style="border-style:solid" bgcolor="white" width="100">
 <font class=text1>
 <tr>
 <td class="compactLinks" align=center >
 <strong>KLOT</strong>
 </td></tr>
 <tr>
 <td align=center>
  <a href="/radar/reflectivity/ref" class="menuA">0.5 Ref </a></td></tr>
 <td align=center>
  <a href="/radar/velocity/vel" class="menuA">0.5 Vel </a></td></tr>
 <td align=center>
  <a href="/radar/zdr/zdr" class="menuA">0.5 Zdr </a></td></tr>
 <!--tr><td align=center>
  <a href="/radar/vel" class="menuA">0.5 Vel </br></a>
 </td></tr-->
</table>
Powered by <a href="http://arm-doe.github.io/pyart/">PyART</a>
</ul>
<div class=model>
<font class=text1>
<?php
$model = "radar";
$c = "ref";
if ($model == null) {$model = "radar"; }
if ($a == null) {$a = "velocity"; }
if ($b == null) {$b = "vel"; }
#if ($c == null) {$c = "ref"; }



    // integer starts at 0 before counting
    $count = 0; 
    $dir = "/home/wxweb/public_html/radar/reflectivity";
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..','old')) && !is_dir($dir.$file)) 
                $count++;
        }
    }
    // prints out how many were in the directory
    //echo "There were $i files";

// GET the information about which model to show, and what hours
$radar = $_GET["a"];
if ($max == null) $max = 1;
if ($siz == null) $siz = m;
if ($a == "reflectivity") {$max = $count;}
if ($a == "velocity") {$max = $count;}
if ($a == "zdr") {$max = $count;}
$total = $count;
$t=1;



#$crc = "http://bergeron.valpo.edu/radar/${a}/${b}_img";

?>

<!--input type=submit value="Go!"-->
</form>
<!--<br><br>-->
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
<!--<br>-->
<!--input type=checkbox name="nostep">Check this box to enable the links below to display the image you select<br-->
<!--<br>-->
<?php
#for ($i = 0; $i < $max; $i++) {
#$newi = $i+1;
#    echo "<a href=\"javascript:step($i)\" onMouseOver=\"step($i)\">$newi</a> | \n";
//};
?>
<div class="radar" style="width:400px;overflow:visible;">
        <img src="" name="animation" width=900></td>
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
for ($i = 0; $i < ($total); $i++) {
 if ($model == "radar") {
  if ($b == "ref") {
    if (file_exists("/home/wxweb/public_html/radar/reflectivity/${b}_img${i}.png")) {
     echo "temp[$j] = \"http://bergeron.valpo.edu/~wxweb/radar/reflectivity/${b}_img$i";
     echo ".png\";\n";
     $j++;
    }
  }
  elseif ($b == "vel") {
    if (file_exists("/home/wxweb/public_html/radar/velocity/${b}_img${i}.png")) {
     echo "temp[$k] = \"http://bergeron.valpo.edu/~wxweb/radar/velocity/${b}_img$i";
     echo ".png\";\n";
     $k++;
    }
  }
  elseif ($b == "zdr") {
    if (file_exists("/home/wxweb/public_html/radar/reflectivity/${b}_img${i}.png")) {
     echo "temp[$l] = \"http://bergeron.valpo.edu/~wxweb/radar/reflectivity/${b}_img$i";
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
document.animation.style.clip="rect(0px,600px,0px,0px)";
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
