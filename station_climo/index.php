<html>
<head>

<script src="jquery.js"></script> 
    <!--script> 
    $(function(){
      $("#includedContent").load(<?php echo 'data/'.$lnum[$typ]; ?>); 
    });
</script-->

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


<body>

<script type="text/javascript">
var index1 = document.getElementById('station');
var value1 = index1.options[index1.selectedIndex].value;
</script>

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
      <li><a href="http://bergeron.valpo.edu/model" align=center><font size=4>WRF Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/ncep_models" align=center><font size=4>GFS Model</font></a></li>
      <li><a href="http://bergeron.valpo.edu/station_climo" align=center><font size=4 color=#ffcc00><b>Sfc Station Climo</b></font></a></li>
      <li><a href="http://www.valpo.edu/geography-meteorology/meteorology/" target="_blank" align=center><font                 size=4>Department Page</font></a></li>
<!--
      <li><a href="http://bergeron.valpo.edu/facstaff" align=center><font size=4>Department Faculty/Staff</font></a></li>
      <li><a href="http://bergeron.valpo.edu/misc" align=center><font size=4>Miscellaneous</font></a></li>
-->
    </center></ul>
    <p>&nbsp;</p>
    <!-- end .sidebar1 --></div>

  <div class="content">

<table width=1000 border=0 class="shortterm" align=center style="background-color: #c8b18b; border-radius:20px;">
  <tr>
    <td align=center valign=top>

<div class=stnclimo>
<font class=text1>
<?php
if ($handle = opendir('/var/www/html/station_climo/data')) {
    $blacklist = array('.', '..','index.php','.htaccess','files');
    $i = 0;
    while (false !== ($file = readdir($handle))) {
        if (!in_array($file, $blacklist)) {
            $i++;
            $lnum[$i] = $file;
        }
    }
    closedir($handle);
}
sort($lnum);
$typ = $_GET["station"];
if ($typ == null) $typ = $i-2;
#$typ = 0;
for ($n = 0; $n <= $i; $n++) {
    #echo $lnum[$n].'<br>';
    if (file_exists("data/$lnum[$n]")) {
        $theData = explode(".",$lnum[$n]);
        list($city[$n], $state[$n], $high[$n], $var[$n]) = explode("_",$theData[0]);
        $myarray[$n] = "$city[$n] $high[$n] $var[$n]";
    }
#    if (file_exists("launches/$lnum[$n]/$lnum[$n]_SUMMARY.txt")) {
#        $theData = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n]_SUMMARY.txt" ));
#        list($month[$n], $day[$n], $year[$n]) = explode("/",$theData[235]);
#        if (strlen($day[$n]) < 2) {
#            $day[$n] = "0$day[$n]";
#        }
#        if (strlen($month[$n]) < 2) {
#            $month[$n] = "0$month[$n]";
#        }
#        list($hour[$n], $minute[$n], $second[$n]) = explode(":",$theData[236]);
#        if (strlen($hour[$n]) < 2) {
#            $hour[$n] = "0$hour[$n]";
#        }
#        $theTime[$n] = "$hour[$n]$minute[$n]";
#        $myarray[$n] = "$month[$n]/$day[$n]/$year[$n] at {$theTime[$n]}Z";
#    }
}
#$ldata = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n].STD" ));
#$convert = explode("\n", $ldata); //create array separate by new line
#$convert = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n].STD" ));
#
#$fpath = file_get_contents("launches/$lnum[$typ]/flight_path.txt"); //read the file
#$fimgs = file_get_contents("launches/$lnum[$typ]/flight_imgs.txt"); //read the file
#
echo '<center>';
echo '<h1 align="center">Surface '.$var[$typ].' from '.$city[$typ].' </h1>';
#
echo '<form method="get">';
echo '<select name="station"  onChange="submit();return false;">';
echo "\r\n";
echo "\r\n";
for ($m = 0; $m < $n-1; $m++) {
    echo '<option value="'.$m.'" ';
    if($typ==$m){
      echo " selected='selected'";
    }
    echo '>'.$myarray[$m].'</option>';
    echo "\r\n";
}
echo'</select>';
echo '&nbsp; &nbsp;'.$city[$typ].' '.$state[$typ].' '.$high[$typ].' '.$var[$typ];
echo '</form>';

?>


<?php
echo '<p>';
echo "\r\n";
echo '<table border = 0 cellpadding="8" style="background-color:None">';
echo "\r\n";
echo '<tr>';
echo "\r\n";
#echo '<td width="50%"><center><a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'_KVUM.png"><img src="launches/'.$lnum[$typ].'/'.$lnum[$typ].'_KVUM.png" alt="skew-T" width="700"></a><br>Click image to enlarge or save</td>';
#echo '<div id="includedContent"></div>';
include('data/'.$lnum[$typ]);
echo "\r\n";
#echo '<tr>';
#echo "\r\n";
#echo '<td><center>'.$fpath.'</td>';
#echo "\r\n";
echo '</table>';
echo "<br>";
#echo '<center>';
#<?php

echo "<h1>Station History</h1>";

if( ($handle = fopen( 'data/files/'.$city[$typ].'_'.$state[$typ].'_sites.txt', 'r' )) !== false )
{
    $output = '<table bgcolor="#FFFFFF" style="border: 1px solid black; border-collapse: collapse">';
    while( ($data = fgetcsv( $handle )) !== false )
    {
        $output .= '<tr style="border: 1px solid black">';
        foreach( $data as $value )
        {
            $output .= sprintf( '<td width=200 align="center" style="border: 1px solid black">%s</td>', $value );
        }
        $output .= '</tr>';
    }
    fclose( $handle );
    $output .= '</table>';
}
echo $output;

#    $tdcount = 3; $numtd = 3; // number of cells per row 
#    print "<table>"; 
#    $f = fopen("data/files/Chicago_IL_sites.txt", "r"); 
#    while (!feof($f)) { 
#        $arrM = explode(",",fgets($f)); 
#        echo current($arrM);
#        $row = current ( $arrM ); 
#        if ($tdcount == 1) 
#            print "<tr>"; print "<td>$row </td>"; 
#        if ($tdcount == $numtd) { 
#            print "</tr>"; 
#            $tdcount = 1; 
#        } else { 
#            $tdcount++; 
#        } 
#    } 
#    if ($tdcount!= 1) { 
#        while ($tdcount <= $numtd) { 
#            print "<td>&nbsp;</td>"; $tdcount++; 
#        } print "</tr>"; 
#    } 
#    print "</table>"; 





#echo "\r\n";
#echo '<h2>Downloadable files</h2><p>';
#echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.LOG">Raw Launch Data (open with RAOB)</a>';
#echo "\r\n";
#echo '<p>';
#echo '<a href="LOG.README">README.LOG</a> (For the RAW Data File)';
#echo "\r\n";
#echo '<p>';
#echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.kml">KML (use with Google Earth)</a>';
#echo "\r\n";
#echo '<br> Some users may need to "right click" link and select "save link as" to get .kml file to download';
#echo '<p>';
#echo "\r\n";
#echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'_KVUM.png">Skew-T (full resolution)</a>';
#echo "\r\n";
#echo '&nbsp; &nbsp; <a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.gem">Sounding in GEMPAK format</a>';
#echo "\r\n";
?>


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

