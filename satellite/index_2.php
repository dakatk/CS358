<html>
<head>

<!-- Radar Animation Script -->
<script type="text/javascript">
<!--
var imax = 30, inc = 2, delay = 100, dwell = 1000, dinc = 100; 
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

temp[0] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img0.png";
temp[1] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img1.png";
temp[2] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img2.png";
temp[3] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img3.png";
temp[4] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img4.png";
temp[5] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img5.png";
temp[6] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img6.png";
temp[7] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img7.png";
temp[8] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img8.png";
temp[9] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img9.png";
temp[10] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img10.png";
temp[11] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img11.png";
temp[12] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img12.png";
temp[13] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img13.png";
temp[14] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img14.png";
temp[15] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img15.png";
temp[16] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img16.png";
temp[17] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img17.png";
temp[18] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img18.png";
temp[19] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img19.png";
temp[20] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img20.png";
temp[21] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img21.png";
temp[22] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img22.png";
temp[23] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img23.png";
temp[24] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img24.png";
temp[25] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img25.png";
temp[26] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img26.png";
temp[27] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img27.png";
temp[28] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img28.png";
temp[29] = "http://bergeron.valpo.edu/~wxweb/satellite/conus/ch2/ch2_img29.png";


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
document.animation.style.clip="rect(0px,300px,0px,0px)";
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
</script><!-- End Radar Animation Script -->

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
.content{padding:0px 10px 0px 10px;width:1000px;float:left;background:#381e0e}
.content ul,.content ol{padding:5px 5px 5px 5px}
ul.nav{moz-border-radius: 15px;-webkit-border-radius: 15px;list-style:none;border-top:0px solid #666;margin-bottom:15px}
ul.nav li{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:0px 0px 5px 0px;border-bottom:0px solid #666}
ul.nav a,ul.nav a:visited{moz-border-radius: 15px;color:#381e0e;-webkit-border-radius: 15px;padding:4px 0px 4px 15px; display: block; width:215px; text-decoration:None; background:#c8b18b}
ul.nav a:hover,ul.nav a:active,ul.nav a:focus{background:#613318;color:#ffcc00;text-decoration:None}
.footer{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:5px 10px 5px 10px; width:980px; background:#c8b18b;        position:relative; clear:both}
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
    <table width=1250>
    <td width=240 valign=center align=center>
    <img src="http://bergeron.valpo.edu/images/valpo_logo.png" alt="Picture" name="Insert_logo" width="170" id="Insert_logo" align="bottom"></a>
    </td>
    <td valign="center" align="center" width=1050 style="moz-border-radius: 15px;-webkit-border-radius: 15px;background: url('http://bergeron.valpo.edu/images/header.png') no-repeat;background-size:1035px;">
    <font size=6 color=#ffffff><b>&nbspDepartment of Geography and Meteorology<br>&nbspOnline Weather Center</b></font>
    </td>
    </table>
  </div>
  <div class="sidebar1">
    <ul class="nav"><center>
      <li><a href="http://bergeron.valpo.edu/" align=center><font size=4>Home</font></a></li>
      <li><a href="http://bergeron.valpo.edu/current" align=center><font size=4>Current Conditions</font></a></li>
      <li><a href="http://bergeron.valpo.edu/mesonet" align=center><font size=4>NWI Mesonet</font></a></li>
      <li><a href="http://bergeron.valpo.edu/forecast" align=center><font size=4>Valpo Forecast</font></a></li>
      <li><a href="http://bergeron.valpo.edu/radar" align=center><font size=4>Valpo Radar</font></a></li>
      <li><a href="http://bergeron.valpo.edu/satellite" align=center><font size=4 color=#ffcc00><b>Regional Satellite</b></font></a></li>
      <li><a href="http://bergeron.valpo.edu/soundings" align=center><font size=4>KVUM Sounding</font></a></li>
      <li><a href="http://bergeron.valpo.edu/model" align=center><font size=4>WRF Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/ncep_models" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/station_climo" align=center><font size=4>Sfc Station Climo</font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font size=4>Department Page</font></a></li>
      <br>
      <center>
      <li><a href="/satellite/index.php">True-Color</a></li>
      <li><a href="/satellite/index_1.php">1: Visible (Blue)</a></li>
      <li><a href="/satellite/index_2.php"><font color=#ffcc00><b>2: Visible (Red)</b></font></a></li>
      <li><a href="/satellite/index_4.php">4: Cirrus (NIR)</a></li>
      <li><a href="/satellite/index_9.php">9: Mid-level WV</a></li>
      <li><a href="/satellite/index_14.php">14: Longwave IR</a></li>

    </center></ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

  <div class="content">

<table width=1002 height=300 style="background: #c8b18b;border-radius:20px;-moz-border-radius:20px;-webkit-border-radius:20px;" align=center>
  <tr>
  <td align=center valign=top>
    
<!--input type=submit value="Go!"-->
</form>
<form name="form">
     <table border=0 width=1002>
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
	  <td align=right width=200><font class="text1"> <strong>Speed: </strong>
            <input value="&lt;&lt;" onclick="delay=delay*inc; show_delay();" name="button2" type="button">
            <input value="&gt;&gt;" onclick="delay=delay/inc; show_delay();" name="button2" type="button"></font>
	  </td>
	  <td><font class=text1>
	   <input value="" name="dly" size="10" type="text" class="maptext"></font>
	  </td>
	</tr>
    </table>
<!--input type=checkbox name="nostep">Check this box to enable the links below to display the image you select<br--><br>
<div class="satellite" style="width:1000px;overflow:auto;">
        <img src="" name="animation" width=1000></td>
</div>

<!--  Delay (ms): <INPUT TYPE=text VALUE="" NAME="delay" SIZE=6> //-->
</form>

  </td>
  </tr>
</table>

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

