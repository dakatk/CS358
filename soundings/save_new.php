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
//document.getElementById('launch').value = "<?php echo $_POST['launch'];?>";
</script>

<?php
echo '<form method="get">';
echo'<select name="launch"  onChange="submit();return false;">';
echo "\r\n";
if ($handle = opendir('/home/kgoebber/http/soundings/launches')) {
    $blacklist = array('.', '..');
    $i = 0;
    while (false !== ($file = readdir($handle))) {
    //while (false !== ($file = array_diff(scandir($directory), array('..', '.')))) {
        if (!in_array($file, $blacklist)) {
            //echo "$file\n";
            $i++;
            $lnum[$i] = $file;
        }
    }
    closedir($handle);
}
sort($lnum);
$typ = $_GET["launch"];
if ($typ == null) $typ = 1;
for ($m = 0; $m <= $i; $m++) {
            $theData = explode(" ",file_get_contents( "launches/$lnum[$m]/$lnum[$m].STD" ));
            list($day[$m], $month[$m], $year[$m]) = explode("/",$theData[5]);
            $theTime[$m] = str_replace(":","",$theData[8]);
            //echo "$month/$day/$year at {$theTime}Z <br>";
            $myarray[$m] = "$month[$m]/$day[$m]/$year[$m] at {$theTime[$m]}Z";
//            echo'<option value="'.$m.'">'.$myarray[$m].'</option>'; 
            echo '<option value="'.$m.'" ';
            if($typ==$m){
              echo " selected='selected'";
            }
            echo '>'.$myarray[$m].'</option>';
//            foreach ($options as $m => $myarray[$m]) {
//                echo '<option value="' . $m . '" ' . ($selected == $m ? ' selected' : '') . '>' . $myarray[$m] . '</option>';
//            }
            //echo ("#$optionId[value=2]").attr('selected','selected');
            echo "\r\n";
}

echo'</select>'; 
//echo '<input type="submit" value="submit">';
echo '</form>';
//echo $typ;

$data = file_get_contents("launches/$lnum[$typ]/$lnum[$typ].STD"); //read the file
$convert = explode("\n", $data); //create array separate by new line

//$filename = "launches/$lnum[$typ]/flight_path.txt";
//echo $filename;
//$handle = fopen($filename, "r");
//$fpath = fread($handle, filesize($filename));
//fclose($handle);
$fpath = file_get_contents("launches/$lnum[$typ]/flight_path.txt"); //read the file
$fimgs = file_get_contents("launches/$lnum[$typ]/flight_imgs.txt"); //read the file

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
echo '<table border = 1 cellpadding="8">';
echo "\r\n";
echo '<tr>';
echo "\r\n";
echo        '<td width="50%"><center><a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.JPG"><img src="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.JPG" alt="skew-T" width="600"></a><br>Click image to enlarge or save</td>';
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
echo '<a href="launches/'.$lnum[$typ].'/'.$lnum[$typ].'.JPG">Skew-T (full resolution)</a>';
echo "\r\n";
?>




<p>
<p>
</BODY>
</HTML>
