<html>
<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Valparaiso University Weather Center</title>
<style type="text/css">body
{font:100%/1.6 Verdana,Arial,Helvetica,sans-serif;background:#381e0e;margin:0;padding:0;color:#000}
ul,ol,dl
{padding:0;margin:0}
h1,h2,h3,h4,h5,h6,p
{margin-top:0;padding-right:0px;padding-left:0px}
a img
{border:none}
a:link
{color:#ffffff;text-decoration:None}
a:visited
{color:#ffffff;text-decoration:None}
a:hover,a:active,a:focus
{text-decoration:None;font-weight: bold;}
.container
{width:1250;background:#381e0e;margin:0 auto;}
.header
{padding:0px 0px 10px 0px;background:#381e0e;width:1240px}
.sidebar1
{padding:0px 0px 0px 0px;float:left;width:230px;background:#381e0e;padding-bottom:50px}
.content
{padding:0px 10px 0px 10px;width:1000px;float:left;background:#381e0e}
.content ul,.content ol
{padding:5px 5px 5px 5px}
ul.nav
{moz-border-radius: 15px;-webkit-border-radius: 15px;list-style:none;border-top:0px solid #666;margin-bottom:15px}
ul.nav li
{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:0px 0px 5px 0px;border-bottom:0px solid #666}
ul.nav a,ul.nav a:visited
{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:4px 0px 4px 15px;display:block;width:215px;text-decoration:None;background:#c8b18b}
ul.nav a:hover,ul.nav a:active,ul.nav a:focus
{background:#613318;color:#ffcc00;text-decoration:None}
.footer
{moz-border-radius: 15px;-webkit-border-radius: 15px;padding:5px 10px 5px 10px; width:980px;background:#c8b18b;position:relative;clear:both}
.fltrt
{float:right;margin-left:8px}
.fltlft
{float:left;margin-right:8px}
.clearfloat
{clear:both;height:0;font-size:1px;line-height:0px}
</style>

</head>

<body>

<div class="container">
  <div class="header">
    <table width=1240>
    <td width=240 valign=center align=center>
    <img src="http://fujita.valpo.edu/~dgoines/images/valpo_logo.png" alt="Picture" name="Insert_logo" width="170" id="Insert_logo" align="bottom"></a>
    </td>
    <td valign="center" align="center" width=1035 style="moz-border-radius: 15px;-webkit-border-radius: 15px;background: url('http://fujita.valpo.edu/~dgoines/images/header.png') no-repeat;background-size:1035px;">
    <font size=6 color=#ffffff><b>&nbspDepartment of Geography and Meteorology<br>&nbspOnline Weather Center</b></font>
    </td>
    </table>
  </div>
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="http://fujita.valpo.edu/~dgoines" align=center><font size=4>Home</font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/forecast" align=center><font size=4 color=#ffcc00><b>Valpo Forecast</b></font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/radar" align=center><font size=4>Local Radar (KLOT)</font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/soundings" align=center><font size=4>KVUM Sounding</font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/wrf" align=center><font size=4>WRF Model</font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/ncep" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font size=4>Department Page</font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/staff" align=center><font size=4>Department Staff</font></a></li>
      <li><a href="http://fujita.valpo.edu/~dgoines/misc" align=center><font size=4>Miscellaneous</font></a></li>
    </ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

  <div id="refresh">

<div id="refresh">
<font color='white'>

<?php
// set feed URL
$url = 'http://152.228.140.57/status.xml';
#echo $url."<br />";
// read feed into SimpleXML object
$sxml = simplexml_load_file($url);

// And now you'll be able to call `$sxml->marketstat->type->buy->volume` as well as other properties.
echo $sxml->date . " ";
echo $sxml->time . " CST<br>";
echo "Temperature: " . $sxml->tmp3 . " F<br>";
$temp = round($sxml->tmp3);
$heatindx = $sxml->heatindx;
$windchill = $sxml->windchill;
$baropresdir = $sxml->baropresdir;
$uparrow = '\u25b2';
$downarrow = '\u25bc';
$rightarrow = '\u25b6';
if ($temp == $windchill) {
  echo "Heat Index: " . $sxml->heatindx . " F<br>";
} elseif ($temp == $heatindx) {
  echo "Wind Chill: " . $sxml->windchill . " F<br>";
} else {
  echo "Heat Index: " . $sxml->heatindx . " F<br>";
  echo "Wind Chill: " . $sxml->windchill . " F<br>";
}
echo "Dew Point: " . $sxml->dewpt . " F<br>";
echo "Humidity: " . $sxml->rh . " %<br>";
echo "Wind: " . $sxml->winddirtxt . " @ " . $sxml->windspd . " mph<br>";
if ($baropresdir == "R") {
  echo "Pressure: " . $sxml->baropres . " mb  ";
  echo json_decode('"'.$uparrow.'"');
  echo "<br>";
} elseif ($baropresdir == "F") {
    echo "Pressure: " . $sxml->baropres . " mb  ";
  echo json_decode('"'.$downarrow.'"');
  echo "<br>";
} else {
    echo "Pressure: " . $sxml->baropres . " mb  ";
  echo json_decode('"'.$rightarrow.'"');
  echo "<br>";
}
echo "Solar: " . $sxml->tmp1 . " K<br>";

?>

</font>
</p></div>

</body>

<br>
<br>

  <div class="footer">
    <table width=985 align=center>
      <tr>
        <td width=246 valign="top" align="center">
          <font color=#ffffff size=3><b><u>Department Address</u></b></font><br>
          <font color=#ffffff size=2>
          <a href="https://www.google.com/maps/place/Kallay-Christopher+Hall,+Valparaiso,+IN+46383/@41.4641356,-87.0393358,353m/data=!3m2!1e3!4b1!4m7!1m4!3m3!1s0x88119a407e1c9c13:0xb141031410a34636!2s1809+Chapel+Dr,+Valparaiso,+IN+46383!3b1!3m1!1s0x88119a3f42448c2b:0xbdc58d9760a66fab" target="_blank">Kallay-Christopher Hall<br>1809 Chapel Drive<br>Valparaiso, IN 46383</a>
          </font>
        </td>
        <td width=246 valign="top" align="center">
          <font color=#ffffff size=3><b><u>University</u></b></font>
          <font color=#ffffff size=2>
          <br><a href="http://www.valpo.edu/about/">About</a href>
          <br><a href="http://www.valpo.edu/studentlife/">Student Life</a href>
          <br><a href="http://www.valpo.edu/admission/">Admissions</a href>
          <br><a href="http://valpoathletics.com/">Athletics</a href>
          <br><a href="http://www.valpo.edu/vuca/">The Arts</a href>
          <br><a href="http://www.valpo.edu/alumni/">Valpo Alumni</a href>
          </font>
        </td>
        <td width=246 valign="top" align="center">
          <font color=#ffffff size=3><b><u>Academics</u></b></font>
          <font color=#ffffff size=2>
          <br><a href="http://www.valpo.edu/cas/">College of Arts & Sciences</a href>
          <br><a href="http://www.valpo.edu/cob/">College of Business</a href>
          <br><a href="http://www.valpo.edu/engineering/">College of Engineering</a href>
          <br><a href="http://www.valpo.edu/nursing/">College of Nursing & Health</a href>
          <br><a href="http://www.valpo.edu/christcollege/">The Honors College</a href>
          <br><a href="http://www.valpo.edu/grad/">Graduate School</a href>
          <br><a href="http://www.valpo.edu/law/">Law School</a href>
          </font>
        </td>
        <td  width=246 valign="top" align="center">
          <font color=#ffffff size=3><b><u>Campus Resources</u></b></font>
          <font color=#ffffff size=2>
          <br><a href="http://www.valpo.edu/directory/index.php">People/Offices</a href>
          <br><a href="http://www.valpo.edu/about/maps-directions/">Maps/Directions</a href>
          <br><a href="http://library.valpo.edu/">Library</a href>
          <br><a href="http://www.valpo.edu/chapel/">Chapel</a href>
          <br><a href="https://valpocareers.silkroad.com/">Employment</a href>
          <br><a href="http://blogs.valpo.edu/alert/">Campus Alerts</a href>
          </font>
        </td>
      </tr>
    </table>
  <!-- end .footer --></div>
<!-- end .content --></div>
<!-- end .container --></div>

</body>
</html>
