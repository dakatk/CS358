<html>

<HEAD>
<link rel="stylesheet" href="http://bergeron.valpo.edu/web_style.css">

<script src="jquery.js"></script> 
    <!--script> 
    $(function(){
      $("#includedContent").load(<?php echo 'data/'.$lnum[$typ]; ?>); 
    });
</script--> 

</HEAD>

<body>
<script type="text/javascript">
var index1 = document.getElementById('station');
var value1 = index1.options[index1.selectedIndex].value;
</script>

<?php
$pagename = 'Surface Station Climatology';
echo '<title> Valparaiso University | '. $pagename. '</title></div>';
?>
<div class="header"><img src="http://bergeron.valpo.edu/images/title1.png"><p>
  Welcome to the Valparaiso University Online Weather Center!  This page is currently under construction.
</div>
<ul class="navbar">
  <li><a href="http://bergeron.valpo.edu/">Home</a>
  <li><a href="http://www.valpo.edu/geomet/met/index.php">Departmental Page</a>
  <li><a href="http://bergeron.valpo.edu/forecast">Valpo Forecast</a>
  <li><a href="http://bergeron.valpo.edu/model">WRF Model</a>
  <li><a href="http://bergeron.valpo.edu/ncep_models">GFS Model</a>
  <li><a href="http://bergeron.valpo.edu/radar">KLOT Radar</a>
  <li><a href="http://bergeron.valpo.edu/soundings">KVUM Launches</a>
  <li><a href="http://bergeron.valpo.edu/station_climo">SFC STN Climo</a>
  <!--li><a href="vpz_radar.html">Radar</a>
  <li><a href="vpz_forecast.html">Forecasts</a>
  <li><a href="instruments.html">Instrumentation</a>
  <li><a href="vpz_sound.html">Soundings</a>
  <li><a href="school_mesonet.html">School Mesonets</a-->
</ul>
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




<p>
<p>
</div>
</font>
</body>
</HTML>
