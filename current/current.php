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
    <ul class="nav">
      <li><a href="http://bergeron.valpo.edu/" align=center><font size=4>Home</font></a></li>
      <li><a href="http://bergeron.valpo.edu/current" align=center><font size=4 color=#ffcc00><b>Current Conditions</b></font></a></li>
      <li><a href="http://bergeron.valpo.edu/mesonet" align=center><font size=4>NWI Mesonet</font></a></li>
      <li><a href="http://bergeron.valpo.edu/forecast" align=center><font size=4>Valpo Forecast</font></a></li>
      <li><a href="http://bergeron.valpo.edu/radar" align=center><font size=4>Local Radar (KLOT)</font></a></li>
      <li><a href="http://bergeron.valpo.edu/soundings" align=center><font size=4>KVUM Sounding</font></a></li>
      <li><a href="http://bergeron.valpo.edu/wrf" align=center><font size=4>WRF Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/ncep" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font                 size=4>Department Page</font></a></li>
      <li><a href="http://bergeron.valpo.edu/staff" align=center><font size=4>Department Staff</font></a></li>
      <li><a href="http://bergeron.valpo.edu/misc" align=center><font size=4>Miscellaneous</font></a></li>
    </ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

 
<div class="content">
<p>
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
$temp = $sxml->tmp3;
$temp = round($temp, 3);
$heatindx = $sxml->heatindx;
$windchill = $sxml->windchill;
$baropresin = $sxml->baropres;
$baropresdir = $sxml->baropresdir;
$a = 1013.25;
$b = 29.92;
$ratio = ($a/$b);
$baropresmb = (float) $baropresin * (float) $ratio;
$val = 1.;
$uparrow = '\u25b2';
$downarrow = '\u25bc';
$rightarrow = '\u25b6';
$degree = '\u00b0';

if ($heatindx > $temp-0.5) {
  echo "Wind Chill: " . $sxml->windchill . " F<br>";
} elseif ($windchill < $temp+0.5) {
  echo "Heat Index: " . $sxml->heatindx . " F<br>";
} else {
  echo "Heat Index: " . $sxml->heatindx . " F<br>";
  echo "Wind Chill: " . $sxml->windchill . " F<br>";
}
echo "Dew Point: " . $sxml->dewpt . " F<br>";
echo "Humidity: " . $sxml->rh . " %<br>";
echo "Wind: " . $sxml->winddirtxt . " @ " . $sxml->windspd . " mph<br>";
if ($baropresdir == "R") {
  echo "Pressure: ". number_format((float)$baropresmb,3,'.','') ." mb ";
  echo json_decode('"'.$uparrow.'"');
  echo "<br>";
} elseif ($baropresdir == "F") {
    echo "Pressure: ". number_format((float)$baropresmb,3,'.','') ." mb ";
  echo json_decode('"'.$downarrow.'"');
  echo "<br>";
} else {
    echo "Pressure: ". number_format((float)$baropresmb,3,'.','') ." mb ";
  echo json_decode('"'.$rightarrow.'"');
  echo "<br>";
}
echo "Solar: " . $sxml->tmp1 . " K<br>";
?>

</font>
</p>

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
