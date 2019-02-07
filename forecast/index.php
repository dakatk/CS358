<html>
<head>

<script src="http://code.jquery.com/jquery-latest.js"></script>

<?php include "/var/www/html/forecast/fcst_parse.php";
$time = $time1[0];
$fcst_time = $time2;
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
.content{padding:0px 10px 0px 10px;width:1000px;float:left;background:#381e0e}
.content ul,.content ol{padding:5px 5px 5px 5px}

.forecast {position: relative; width:100%; height:95%;color: black;}
.cloud {position: relative; text-align:center; top: -50%; left: 0%; font-weight:bold}
.precip { position: relative; text-align:center; top: -140px; left: 0%; font-weight:bold}
.hightemp { position: relative; text-align:center; top: -117px; left: 0%; font-weight:bold}
.lowtemp { position: relative; text-align:center; top: -115px; left: 0%; font-weight:bold}
.wind {position: relative; text-align:center; top: -95px; left: 0%; font-weight:bold}
.wind_short {position: relative; text-align:center; top: -77px; left: 0%; font-weight:bold}
.temp_short { position: relative; text-align:center; top: -117px; left: 0%; font-weight:bold}


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
    <font size=6 color=#ffffff><b>&nbspDepartment of Geography and Meteorology<br>&nbspOnline Weather Center</b></font>
    </td>
    </table>
  </div>
  <div class="sidebar1">
    <ul class="nav"><center>
      <li><a href="http://bergeron.valpo.edu" align=center><font size=4>Home</font></a></li>
      <li><a href="http://bergeron.valpo.edu/current" align=center><font size=4>Current Conditions</font></a></li>
      <li><a href="http://bergeron.valpo.edu/mesonet" align=center><font size=4>NWI Mesonet</font></a></li>
      <li><a href="http://bergeron.valpo.edu/forecast" align=center><font size=4 color=#ffcc00><b>Valpo Forecast</b></font></a></li>
      <li><a href="http://bergeron.valpo.edu/radar" align=center><font size=4>Valpo Radar</font></a></li>
      <li><a href="http://bergeron.valpo.edu/satellite" align=center><font size=4>Regional Satellite</font></a></li>
      <li><a href="http://bergeron.valpo.edu/soundings" align=center><font size=4>KVUM Sounding</font></a></li>
      <li><a href="http://bergeron.valpo.edu/model" align=center><font size=4>WRF Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/ncep_models" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/station_climo" align=center><font size=4>Sfc Station Climo</font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font                 size=4>Department Page</font></a></li>
<!--
      <li><a href="http://bergeron.valpo.edu/facstaff" align=center><font size=4>Department Faculty/Staff</font></a></li>
      <li><a href="http://bergeron.valpo.edu/misc" align=center><font size=4>Miscellaneous</font></a></li>
-->
    </center></ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

  <div class="content">

<table width=1000 height=375 border=0 class="shortterm" align=center style="background-color: #c8b18b; border-radius:20px;">
  <tr>
    <td align=center valign=top>
      <font size=4><b>Valpo Forecast</b></font><br><br>

      <table width=980 border=0 cellspacing=1 cellpadding=0 class="shortterm">
        <tr align="center">

          <td valign="top" align="center" width=200 height=200 style="background-color: #ffcc00; border-radius:20px;">
            <b><?php echo $fcst_per1_day[0]; ?></b>
            <div class="forecast">
            <img src='http://bergeron.valpo.edu/images/future<?php if (ltrim($fcst_per1_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per1_cloud[1]); } else {echo ltrim($fcst_per1_cloud[1].'n');}} else {echo ltrim($fcst_per1_precip[1]);}?>.jpg' style="width:100%; height:100%;border-radius:20px;">
            <div class="cloud"><?php echo $fcst_per1_cloud[2]; ?></div>
            <div class="precip"><?php echo $fcst_per1_pop[1]; if (ltrim($fcst_per1_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per1_precip[2];} else {echo "% Chance of Precip";} ?></div>
            <div class="temp_short"><?php echo $fcst_per1_high[0];?>:<?php echo $fcst_per1_high[1];?> &deg;F</div>
            <div class="wind_short"><?php echo $fcst_per1_wd[1]; ?> <?php echo $fcst_per1_ws[1]; ?> kts</div>
            </div>
          </td>
          
          <td valign="top" align="center" width=200 height=200 style="background-color: #ffcc00; border-radius:20px;">
            <b><?php echo $fcst_per2_day[0]; ?></b>
            <div class="forecast">
            <img src='http://bergeron.valpo.edu/images/future<?php if (ltrim($fcst_per1_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per1_cloud[1]); } else {echo ltrim($fcst_per1_cloud[1].'n');}} else {echo ltrim($fcst_per1_precip[1]);}?>.jpg' style="width:100%; height:100%;border-radius:20px;">
            <div class="cloud"><?php echo $fcst_per2_cloud[2]; ?></div>
            <div class="precip"><?php echo $fcst_per2_pop[1]; if (ltrim($fcst_per2_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per2_precip[2];} else {echo "% Chance of Precip";} ?></div>
            <div class="temp_short"><?php echo $fcst_per2_low[0];?>:<?php echo $fcst_per2_low[1];?> &deg;F</div>
            <div class="wind_short"><?php echo $fcst_per2_wd[1]; ?> <?php echo $fcst_per2_ws[1]; ?> kts</div>
            </div>
          </td>
          
          <td valign="top" align="center" width=200 height=200 style="background-color: #ffcc00; border-radius:20px;">
            <b><?php echo $fcst_per3_day[0]; ?></b>
            <div class="forecast">
            <img src='http://bergeron.valpo.edu/images/future<?php if (ltrim($fcst_per3_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per3_cloud[1]); } else {echo ltrim($fcst_per3_cloud[1].'n');}} else {echo ltrim($fcst_per3_precip[1]);}?>.jpg' style="width:100%; height:100%;border-radius:20px;">
            <div class="cloud"><?php echo $fcst_per3_cloud[2]; ?></div>
            <div class="precip"><?php echo $fcst_per3_pop[1]; if (ltrim($fcst_per3_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per3_precip[2];} else {echo "% Chance of Precip";} ?></div>
            <div class="hightemp"><?php echo $fcst_per3_high[0];?>:<?php echo $fcst_per3_high[1];?> &deg;F</div>
            <div class="lowtemp"><?php echo $fcst_per3_low[0];?>:<?php echo $fcst_per3_low[1];?> &deg;F</div>
            <div class="wind"><?php echo $fcst_per3_wd[1]; ?> <?php echo $fcst_per3_ws[1]; ?> kts</div>
            </div>
          </td>
          
          <td valign="top" align="center" width=200 height=200 style="background-color: #ffcc00; border-radius:20px;">
            <b><?php echo $fcst_per4_day[0]; ?></b>
            <div class="forecast">
            <img src='http://bergeron.valpo.edu/images/future<?php if (ltrim($fcst_per4_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per4_cloud[1]); } else {echo ltrim($fcst_per4_cloud[1].'n');}} else {echo ltrim($fcst_per4_precip[1]);}?>.jpg' style="width:100%; height:100%;border-radius:20px;">
            <div class="cloud" width=150><?php echo $fcst_per4_cloud[2]; ?></div>
            <div class="precip"><?php echo $fcst_per4_pop[1]; if (ltrim($fcst_per4_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per4_precip[2];} else {echo "% Chance of Precip";} ?></div>
            <div class="hightemp"><?php echo $fcst_per4_high[0];?>:<?php echo $fcst_per4_high[1];?> &deg;F</div>
            <div class="lowtemp"><?php echo $fcst_per4_low[0];?>:<?php echo $fcst_per4_low[1];?> &deg;F</div>
            <div class="wind"><?php echo $fcst_per4_wd[1]; ?> <?php echo $fcst_per4_ws[1]; ?> kts</div>
            </div>
          </td>
          
          <td valign="top" align="center" width=200 height=200 style="background-color: #ffcc00; border-radius:20px;">
            <b><?php echo $fcst_per5_day[0]; ?></b>
            <div class="forecast">
            <img src='http://bergeron.valpo.edu/images/future<?php if (ltrim($fcst_per5_precip[1])=='none') {if ($time>7|$time<19) {echo ltrim($fcst_per5_cloud[1]); } else {echo ltrim($fcst_per5_cloud[1].'n');}} else {echo ltrim($fcst_per5_precip[1]);}?>.jpg' style="width:100%; height:100%;border-radius:20px;">
            <div class="cloud"><?php echo $fcst_per5_cloud[2]; ?></div>
            <div class="precip"><?php echo $fcst_per5_pop[1]; if (ltrim($fcst_per5_precip[1])!='none') {echo "&#37; Chance of "; echo $fcst_per5_precip[2];} else {echo "% Chance of Precip";} ?></div>
            <div class="hightemp"><?php echo $fcst_per5_high[0];?>:<?php echo $fcst_per5_high[1];?> &deg;F</div>
            <div class="lowtemp"><?php echo $fcst_per5_low[0];?>:<?php echo $fcst_per5_low[1];?> &deg;F</div>
            <div class="wind"><?php echo $fcst_per5_wd[1]; ?> <?php echo $fcst_per5_ws[1]; ?> kts</div>
            </div>
          </td>


        </tr>
      </table>

    </td>
  </tr>
</table>

<br>

<table width=1000 border=0 class="shortterm" align=center style="background-color: #c8b18b; border-radius:20px;">
  <tr>
    <td align=center valign=top>
      <font size=4><b>Forecast Graphic</b>
      </font>
      <br>
      <img src="http://bergeron.valpo.edu/forecast/current_wxgraphic.jpg" border=0 width=800 vspace=5>
    </td>
  </tr>
</table>

<br>

<table width=1000 border=0 class="shortterm" align=center style="background-color: #c8b18b; border-radius:20px;">
  <tr>
    <td align=center valign=top width=1000>
      <font size=4><b>Forecast Discussion</b>
      <br><br>
      <div><p><?php include('/var/www/html/internal/discussion.txt'); ?></p></div>
    </td>
  </tr>
</table>

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
<!-- end .refresh --></div>

</html>

