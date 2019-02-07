<html>
<head>

<script src="http://code.jquery.com/jquery-latest.js"></script>

<?php include "./forecast/fcst_parse.php";
$time = $time1[0];
$fcst_time = $time2;
?>



<!-- 
<meta http-equiv="refresh" content="2">
-->
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

<div id="refresh">
<body>

<div class="container">
  <div class="header">
    <table width=1240>
    <td width=240 valign=center align=center>
    <img src="http://bergeron.valpo.edu/images/valpo_logo.png" alt="Picture" name="Insert_logo" width="170" id="Insert_logo" align="bottom"></a>
    </td>
    <td valign="center" align="center" width=1035 style="moz-border-radius: 15px;-webkit-border-radius: 15px;background: url('http://bergeron.valpo.edu/images/header.png') no-repeat;background-size:1035px;">
    </td>
    </table>
  </div>
  <div class="sidebar1">
    <ul class="nav"><center>
      <li><a href="http://bergeron.valpo.edu/" align=center><font size=4 color=#ffcc00><b>Home</b></font></a></li>
      <li><a href="http://bergeron.valpo.edu/current" align=center><font size=4>Current Conditions</font></a></li>
      <li><a href="http://bergeron.valpo.edu/mesonet" align=center><font size=4>NWI Mesonet</font></a></li>
      <li><a href="http://bergeron.valpo.edu/forecast" align=center><font size=4>Valpo Forecast</font></a></li>
      <li><a href="http://bergeron.valpo.edu/radar" align=center><font size=4>Valpo Radar</font></a></li>
      <li><a href="http://bergeron.valpo.edu/satellite" align=center><font size=4>Regional Satellite</font></a></li>
      <li><a href="http://bergeron.valpo.edu/soundings" align=center><font size=4>KVUM Sounding</font></a></li>
      <li><a href="http://bergeron.valpo.edu/model" align=center><font size=4>WRF Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/ncep_models" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/station_climo" align=center><font size=4>Sfc Station Climo</font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font size=4>Department Page</font></a></li>
<!--
      <li><a href="http://bergeron.valpo.edu/facstaff" align=center><font size=4>Department Faculty/Staff</font></a></li>
      <li><a href="http://bergeron.valpo.edu/misc" align=center><font size=4>Miscellaneous</font></a></li>
-->
    </center></ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

  <div class="content">

<table width=900 height=44 align="center" valign="center">
  <tr>
    <td align="center" height=44>
      <font size=6 color=#ffffff>
      <b>&nbspDepartment of Geography and Meteorology<br></b>
      </font>
      <font color="#ffffff" size=5>
      <b>Welcome to the Online Weather Center!</b>
      </font>
    </td>
  </tr>
</table>

<table width=1000>
<tr>
<td align="left">
<table width=490 align="left" height=210>
  <tr>
  <td align=center valign=top>
  <a href='http://bergeron.valpo.edu/current'>
    <font size=4><b>Current Conditions</b>
    </font>
  <br><br>


</a>
  </td>
  </tr>
</table>
</td>
<td>
<table width=490 height=210 align="right">
  <tr>
    <!-- Valparaiso Short Term Forecast -->
    <td align=center valign=top>
    <a href='http://bergeron.valpo.edu/forecast'><font size=4><b>Short Term Forecast</b></font><br><br>
      <table width=470 border=0 cellspacing=0 cellpadding=1 class="shortterm">
        <tr align="center">
          <td align="center" width=120><?php echo $fcst_per1_day[0]; ?></td>
          <td align="center" width=120><?php echo $fcst_per2_day[0]; ?></td>
        </tr>
      </table>

      <table width=470>
        <tr>
          <td>
            <table width=235 border=0 cellspacing=0 cellpadding=1 class="shortterm">
              <tr valign="top" height="40%" style="background: url('http://bergeron.valpo.edu/images/today<?php if (ltrim($fcst_per1_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per1_cloud[1]); } else {echo ltrim($fcst_per1_cloud[1].'n');}} else {echo ltrim($fcst_per1_precip[1]);}?>.jpg') no-repeat 0 0; position: relative;">
                <td align="center">
                  <FONT class="weather"><b><?php echo $fcst_per1_cloud[2]; ?></FONT><br>
                  <FONT class="weather"><b><?php echo $fcst_per1_pop[1]; if (ltrim($fcst_per1_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per1_precip[2];} else {echo "% Chance of Precip";} ?></FONT>
                </td>
                <td align="center" width=100>
                  <FONT class="subheader"><b><?php if ($time>7|$time<19){echo $fcst_per1_high[0]; } else {echo $fcst_per1_low[0]; }?>:</FONT><BR>
                  <FONT class="variablesmall"><b><?php if ($time>7|$time<19){echo $fcst_per1_high[1];} else {echo $fcst_per1_low[1];}?> &deg;F </FONT><BR><BR>
                  <FONT class="subheader"><b>Wind:</FONT><BR>
                  <FONT class="variablesmall"><b><?php echo $fcst_per1_wd[1]; ?> <?php echo $fcst_per1_ws[1]; ?> kts</FONT>
                </td>
              </tr>
            </table>
          </td>
          <td>
            <table width=235 border=0 cellspacing=0 cellpadding=1 class="shortterm">
              <tr valign="top" height="80px"
                style="background: url('http://bergeron.valpo.edu/images/today<?php if (ltrim($fcst_per2_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per2_cloud[1].'n'); } else {echo ltrim($fcst_per2_cloud[1]);}} else {echo ltrim($fcst_per2_precip[1]);}?>.jpg') no-repeat 0 0; position: relative;"> 
                <td align="center">
                  <FONT class="weather"><b><?php echo $fcst_per2_cloud[2]; ?></FONT><br>
                  <FONT class="weather"><b><?php echo $fcst_per2_pop[1]; if (ltrim($fcst_per2_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per2_precip[2];} else {echo "% Chance of Precip";} ?></FONT>
                </td>
                <td align="center" width=100>
                  <FONT class="subheader"><b><?php if ($time>7|$time<19) {echo $fcst_per2_low[0]; } else {echo $fcst_per2_high[0]; }?>:</FONT><BR>
                  <FONT class="variablesmall"><b><?php if ($time>7|$time<19) {echo $fcst_per2_low[1];} else {echo $fcst_per2_high[1];} ?> &deg;F </FONT><BR><BR>
                  <FONT class="subheader"><b>Wind:</FONT><BR>
                  <FONT class="variablesmall"><b><?php echo $fcst_per2_wd[1]; ?> <?php echo $fcst_per2_ws[1]; ?> kts</FONT>

                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <table width=470 border=0 cellspacing=0 cellpadding=1 class="shortterm">
        <tr align="center" width=470>
          <td valign="top" class="foot" colspan="2">&copy; <?php echo date(Y)?> Valparaiso University
          </td>
        </tr>
        <tr align="center">
          <td valign="top" class="foot" colspan="2">Last Updated: <?php echo $fcst_time; ?>
          </td>
        </tr>
      </table>
    </a>
    </td>
  </tr>
</table>
</td>
<tr>
</table>

<table width=1000>
<tr>

<td align="center">
<table width=490 height=325 align="left">
  <tr>
  <!-- Valparaiso WRF Forecast Graphic -->
  <td align=center valign=top>
  <a href="http://bergeron.valpo.edu/radar">
    <font size=4><b>Local Radar</b></font>
    <img src="http://bergeron.valpo.edu/~wxweb/radar/reflectivity/ref_img0.png" width=450 height=275>
  </a>
  </td>
  </tr>
</table>
</td>

<td align="center">
<table width=490 height=325 align="right">
  <tr>
  <!-- Valparaiso WRF Forecast Graphic -->
  <td align=center valign=top>
  <a href="http://bergeron.valpo.edu/model">
    <font size=4><b>WRF Forecast</b></font><br>
    <div style="width: 450px; height: 275px; overflow: hidden">
    <img src="http://bergeron.valpo.edu/model/WRF/sfc_mslp_tmpf_wind_f000.png" width="450">
    </div>
  </a>
  </td>
  </tr>
</table>
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
<!-- end .refresh --></div>

</html>

