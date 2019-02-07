<html>
<head>
<title>File Upload Form</title>
</head>
<body>
This allows you to upload sounding files to the server.<br>

<form name="sounding" action="getfile.php" method="post" enctype="multipart/form-data">
Select files to upload: <input type="file" name="uploadFile[]" multiple>
<input type="submit" value="Upload Files">
</form>

<form name="flightpath" action="getflightpath.php" method="post"><br>
This allows you to upload the Google Earth flight path (if available).<br>
Select the flight number: 

<?php

if ($handle = opendir('/home/kgoebber/http/soundings/launches')) {
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
$n = count($lnum);
$typ = $n-1;

echo'<select name="launch">';
echo "\r\n";
for ($m = 0; $m < $n; $m++) {
    echo '<option value="'.$lnum[$m].'" ';
    if($typ==$m){
      echo " selected='selected'";
    }
    echo '>'.$lnum[$m].'</option>';
    echo "\r\n";
}
echo'</select>';
echo '<br>';


?>

Type HTML code for Google Earth flight path: <br><textarea rows="5" cols="75" name="path" wrap="virtual"></textarea><br>
<input type="submit" value="Submit">
</form>

</body>
</html>
