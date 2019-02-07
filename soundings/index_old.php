<html>
<HEAD>
<link rel="stylesheet" href="http://fujita.valpo.edu/web_style.css">
</HEAD>


<body>
<script type="text/javascript">
var index1 = document.getElementById('launch');
var value1 = index1.options[index1.selectedIndex].value;
</script>

<?php
$pagename = 'Soundings - KVUM Balloon Launches';
echo '<title> Valparaiso University | '. $pagename. '</title></div>';
?>
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
  <!--li><a href="vpz_radar.html">Radar</a>
  <li><a href="vpz_forecast.html">Forecasts</a>
  <li><a href="instruments.html">Instrumentation</a>
  <li><a href="vpz_sound.html">Soundings</a>
  <li><a href="school_mesonet.html">School Mesonets</a-->
</ul>
<div class=sounding>
<font class=text1>
<?php
if ($handle = opendir('/var/www/html/soundings/launches')) {
    $blacklist = array('.', '..','007_001','039_002','.htaccess');
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
$typ = $_GET["launch"];
if ($typ == null) $typ = $i-1;
for ($n = 0; $n <= $i; $n++) {
    if (file_exists("launches/$lnum[$n]/$lnum[$n].STD")) {
        $theData = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n].STD" ));
        list($day[$n], $month[$n], $year[$n]) = explode("/",$theData[5]);
        $theTime[$n] = str_replace(":","",$theData[8]);
        $myarray[$n] = "$month[$n]/$day[$n]/$year[$n] at {$theTime[$n]}Z";
    }
    if (file_exists("launches/$lnum[$n]/$lnum[$n]_SUMMARY.txt")) {
        $theData = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n]_SUMMARY.txt" ));
        list($day[$n], $month[$n], $year[$n]) = explode("/",$theData[235]);
        if (strlen($day[$n]) < 2) {
            $day[$n] = "0$day[$n]";
        }
        if (strlen($month[$n]) < 2) {
            $month[$n] = "0$month[$n]";
        }
        list($hour[$n], $minute[$n], $second[$n]) = explode(":",$theData[236]);
        if (strlen($hour[$n]) < 2) {
            $hour[$n] = "0$hour[$n]";
        }
        $theTime[$n] = "$hour[$n]$minute[$n]";
        $myarray[$n] = "$month[$n]/$day[$n]/$year[$n] at {$theTime[$n]}Z";
    }
}
$ldata = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n].STD" ));
$convert = explode("\n", $ldata); //create array separate by new line
$convert = explode(" ",file_get_contents( "launches/$lnum[$n]/$lnum[$n].STD" ));

$fpath = file_get_contents("launches/$lnum[$typ]/flight_path.txt"); //read the file
$fimgs = file_get_contents("launches/$lnum[$typ]/flight_imgs.txt"); //read the file

echo '<center>';
echo '<h1>Sounding taken '.$month[$typ].'-'.$day[$typ].'-'.$year[$typ].' at '.$theTime[$typ].'Z </h1>';

echo '<form method="get">';
echo'<select name="launch"  onChange="submit();return false;">';
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
echo '&nbsp; &nbsp; Flight Number '.$lnum[$typ];
echo '</form>';



echo '<p>';
echo "\r\n";
echo '<table border = 1 cellpadding="8" style="background-color:white">';
echo "\r\n";
echo '<tr>';
echo "\r\n";
echo        '<td width="50%"><center><a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'_KVUM.png"><img src="launches/'.$lnum[$typ].'/'.$lnum[$typ].'_KVUM.png" alt="skew-T" width="600"></a><br>Click image to enlarge or save</td>';
echo "\r\n";
//echo   '<td width="50%"><center><a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'preflight.pdf.png"><img src="launches/'.$lnum[$typ].'/'.$lnum[$typ].'preflight.pdf.png" alt="Preflight Information" width="600"></a><p>Click image to enlarge or save</td>'
echo '<td width=50% ><left><pre>';
for ($j=0;$j<32;$j++)               
{
    echo $convert[$j]; //write value by index
    echo "\n";
}
echo '</pre> </td>';
echo "\r\n";
echo '<tr>';
echo "\r\n";
//echo '<td width="50%"><center><br>Flight path of the weather balloon and radiosonde!<p><iframe width="600" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=docs:%2F%2F0B0eADCQMOu_4cHhNUDZvTHdRN2M&output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?q=docs:%2F%2F0B0eADCQMOu_4cHhNUDZvTHdRN2M" style="color:#0000FF;text-align:left">View Larger Map</a></small></td>';
echo '<td><center>'.$fpath.'</td>';
echo "\r\n";
//echo '<td width="50%"><center>Check out an awesome time-lapse of the launch courtesy of Matt Schaeffer!<br><iframe width="560" height="400" src="//www.youtube.com/embed/foPLbAADqQQ" frameborder="0" allowfullscreen></iframe></td>';
echo '<td><center>'.$fimgs.'</td>';
echo "\r\n";
echo '</table>';
echo '<center>';
echo "\r\n";
echo '<h2>Downloadable files</h2><p>';
echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.LOG">Raw Launch Data (open with RAOB)</a>';
echo "\r\n";
echo '<p>';
echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.kml">KML (use with Google Earth)</a>';
echo "\r\n";
echo '<br> Some users may need to "right click" link and select "save link as" to get .kml file to download';
echo '<p>';
echo "\r\n";
echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'_KVUM.png">Skew-T (full resolution)</a>';
echo "\r\n";
echo '&nbsp; &nbsp; <a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.gem">Sounding in GEMPAK format</a>';
echo "\r\n";
?>




<p>
<p>
</div>
</font>
</body>
</HTML>
