<html>
<!-- From http://www.htmlgoodies.com/beyond/php/article.php/3472551 -->
<head>
<title>Process Uploaded File</title>
</head>
<body>
<?php

$fileName = $_FILES["uploadFile"]["name"];
$fileTmpLoc = $_FILES["uploadFile"]["tmp_name"];

$i = 0;
$a = 0;
foreach ($_FILES['uploadFile']['name'] as $filename) {
        echo '<li>' . $filename . '</li>';
//        echo $i . "\r\n";
        echo '<li>' . $fileTmpLoc[$i] . '</li>';
        $moveResult = move_uploaded_file($fileTmpLoc[$i], $filename);
// Evaluate the value returned from the function if needed
        if ($moveResult == true) {
           echo "These files have been uploaded: " . $filename ."\r\n";
           $a = 1;
        } else {
           echo "ERROR: Files not moved correctly";
           echo $_FILES["uploadFile"]["tmp_name"];
        }
        $i++;
}





//echo $fileName;
//echo $fileTmpLoc[0];
if ($a == 1) {
  echo exec('touch /var/www/html/upload/files_to_run.txt');
  echo '<p>';
  echo 'Sounding should be available at <a href="http://bergeron.valpo.edu/soundings">here</a> in about 1 minute.';
}
//echo "I GOT HERE \n";
//exec('whoami');

?>
</body>
</html>
