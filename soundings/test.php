<html>
<HEAD>
<title>Beta Radiosonde Site</title>
<style>
</style>
<link href="/home/abrainar/public_html/sounding/css/default.css" rel="stylesheet" type="text/css" />
</HEAD>


<BODY>
<script type="text/javascript">
var index1 = document.getElementById('launch');
var value1 = index1.options[index1.selectedIndex].value;
</script>

<?php
echo '<form method="get">';
echo'<select name="launch">';
if ($handle = opendir('launches')) {
    $blacklist = array('.', '..');
    $i = 0;
    while (false !== ($file = readdir($handle))) {
        if (!in_array($file, $blacklist)) {
            //echo "$file\n";
            $i++;
            $lnum[$i] = $file;
            $theData = explode(" ",file_get_contents( "launches/$file/$file.STD" ));
            list($day[$i], $month[$i], $year[$i]) = explode("/",$theData[5]);
            $theTime[$i] = str_replace(":","",$theData[8]);
            //echo "$month/$day/$year at {$theTime}Z <br>";
            $myarray[$i] = "$month[$i]/$day[$i]/$year[$i] at {$theTime[$i]}Z";
            echo'<option value="'.$i.'">'.$myarray[$i].'</option>'; 
            echo "\r\n";
        }
        
    }
    closedir($handle);
}
echo'</select>'; 
echo '<input type="submit" value="submit">';
echo '</form>';
$typ = $_GET["launch"];
if ($typ == null) $typ = 1;
echo $typ;

$data = file_get_contents("launches/$lnum[$typ]/$lnum[$typ].STD"); //read the file
$convert = explode("\n", $data); //create array separate by new line

//for ($j=0;$j<32;$j++) 
//{
//    echo $convert[$j]."<br>"; //write value by index
//}

//$flightdata = file_get_contents( "launches/$lnum[$typ]/$lnum[$typ].STD", NULL, NULL, 20, 14);
//$flightdata = file_get_contents( "launches/$lnum[$typ]/$lnum[$typ].STD");
//echo $flightdata;

echo '<center>';
echo '<h1>Sounding taken '.$month[$typ].'-'.$day[$typ].'-'.$year[$typ].' at '.$theTime[$typ].'Z </h1>';
echo 'Flight Number '.$lnum[$typ];
echo '<p>';
echo "\r\n";
echo '<table border = 1 >';
echo "\r\n";
echo '<tr>';
echo "\r\n";
echo        '<td width="50%"><center><a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.JPG"><img src="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.JPG" alt="skew-T" width="600"></a><br>Click image to enlarge or save</td>';
echo "\r\n";
//echo   '<td width="50%"><center><a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'preflight.pdf.png"><img src="launches/'.$lnum[$typ].'/'.$lnum[$typ].'preflight.pdf.png" alt="Preflight Information" width="600"></a><p>Click image to enlarge or save</td>'
echo '<td width=50%><left>';
for ($j=0;$j<32;$j++)               
{
    echo $convert[$j]."<br>"; //write value by index
}
echo ' </td>';
?>
<tr>
<td width="50%"><center><br>Flight path of the weather balloon and radiosonde!<p><iframe width="600" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=docs:%2F%2F0B0eADCQMOu_4cHhNUDZvTHdRN2M&output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?q=docs:%2F%2F0B0eADCQMOu_4cHhNUDZvTHdRN2M" style="color:#0000FF;text-align:left">View Larger Map</a></small></td>
<td width="50%"><center>Check out an awesome time-lapse of the launch courtesy of Matt Schaeffer!<br><iframe width="560" height="400" src="//www.youtube.com/embed/foPLbAADqQQ" frameborder="0" allowfullscreen></iframe></td>
</table>
<center>
<h2>Downloadable files</h2><p>
<a href="099_001.LOG">Raw Launch Data (open with RAOB)</a>
<p>
<a href="099_001.kml">KML (use with Google Earth)</a>
<br> Some users may need to 'right click' link and select 'save link as' to get .kml file to download
<p>
<a href="099_001.JPG">Skew-T (full resolution)</a>




<p>
<p>
</BODY>
</HTML>
