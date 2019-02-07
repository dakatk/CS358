<html>
<!-- From http://www.htmlgoodies.com/beyond/php/article.php/3472551 -->
<head>
<title>Process Uploaded Flightpath</title>
</head>
<body>
<?php

$flightnum = $_POST["launch"];
$folder = "/home/kgoebber/http/upload/" . $flightnum;
echo $_POST["launch"];
echo '<br><br>';
$file = $folder . "_flight_path.txt";
echo $file;
echo '<br><br>';

echo $_POST["path"];
$data = $_POST["path"];

//file_put_contents($file,$data);

$handle = fopen($file, 'w');
fwrite($handle, $data);
fclose($handle);


//$fileName = $_FILES["uploadFile"]["name"];
//$fileTmpLoc = $_FILES["uploadFile"]["tmp_name"];

//$i = 0;
//$a = 0;
//foreach ($_FILES['uploadFile']['name'] as $filename) {
//        echo '<li>' . $filename . '</li>';
////        echo $i . "\r\n";
//        $moveResult = move_uploaded_file($fileTmpLoc[$i], $filename);
//// Evaluate the value returned from the function if needed
//        if ($moveResult == true) {
//           echo "This file has been uploaded: " . $filename ."\r\n";
//           $a = 1;
//        } else {
//           echo "ERROR: File not moved correctly";
//        }
//        $i++;
//}



////echo $fileName;
////echo $fileTmpLoc[0];
//if ($a == 1) {
echo exec('touch /home/kgoebber/http/upload/flightpath_to_run.txt');
echo '<p>';
echo 'File should be available at <a href="http://fujita.valpo.edu/soundings">here</a> in about 1 minute.';
//}
////echo "I GOT HERE \n";
////exec('whoami');

?>
</body>
</html>
