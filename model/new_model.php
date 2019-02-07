<?php
  if ($_COOKIE['usrip'] != "COUNTEDASORIGINALUSER") {
  $cntadd = 1;
  setcookie("usrip","COUNTEDASORIGINALUSER",0,"/");
  } else {$cntadd = 0; }
import_request_variables('gp');
if ($a == null) {$a = "wrf"; }
if ($b == null) {$b = "wind"; }
if ($c == null) {$c = "500mb"; }

if ($fh = null) {$fh = 0; }

include "operations.php";


if (!array_key_exists($c,$menuC)) {$c = $Cdefault[$b];}
//**** this section will calculate the hour that the model is displaying 
// ie: ruc(03z), this determines the "03z" part. 
	$hour = gmdate('G');
	// set delays for the number of seconds after the time the model is initiated, to when it is posted. 
	$Gdly = 4*3600;
	$Ndly = 2*3600+900;
	$Rdly = 3600;
	$Edly = 6*3600;
	$oGhr = gmdate('G',time()-(6*3600)-$Ndly);
	$oNhr = gmdate('G',time()-(6*3600)-$Ndly);
	$oRhr = gmdate('G',time()-(3*3600)-$Rdly);
	$oEhr = gmdate('G',time()-(12*3600)-$Edly);
	$ftime['gfs'] = sprintf('%02.0f',(floor(gmdate('G',time()-$Gdly)/6) * 6))."z";
	$ftime['gfs/prev'] = sprintf('%02.0f',(floor($oGhr/6) * 6))."z";
	$ftime['ecmwf'] = sprintf('%02.0f',(floor(gmdate('G',time()-$Edly)/12) * 12))."z";
	$ftime['ecmwf/prev'] = sprintf('%02.0f',(floor($oEhr/12) * 12))."z";
	$ftime['nam'] = sprintf('%02.0f',(floor(gmdate('G',time()-$Ndly)/6) * 6))."z";
	$ftime['nam/prev'] = sprintf('%02.0f',(floor($oNhr/6) * 6))."z";
	$ftime['ruc'] = sprintf('%02.0f',(floor(gmdate('G',time()-$Rdly)/3)*3))."z";
	$ftime['ruc/prev'] = sprintf('%02.0f',(floor($oRhr/3)*3))."z";
#if (!in_array($c,$menuC)) {$c = $menuC[0]; }

$menuA = array (
	"wrf" => "Current <br />OWL WRF,,OWL WRF",
#	"wrf_prev" => "Prev<br />WRF,,Previous OWL WRF",
#	"ecmwf" => "Current <br />EURO (".$ftime['ecmwf']."),,ECMWF",
#	"ecmwf_prev" => $ftime['ecmwf/prev']."<br />EURO,,Previous ECMWF",
#	"gfs" => "Current <br />GFS (".$ftime['gfs']."),,GFS",
#	"gfs_prev" => $ftime['gfs/prev']."<br />GFS,,Previous GFS",
#	"ruc" => "Current <br />RUC (".$ftime['ruc']."),,RUC",
#	"ruc_prev" => $ftime['ruc/prev']."<br />RUC,,Previous RUC",
#	"nam" => "Current <br /> NAM (".$ftime['nam']."),,NAM",
#	"nam_prev" => $ftime['nam/prev']."<br />NAM,,Previous NAM",
	
);
$menuSettings = array (
   "a" => array ("Select Model",2), 
   "b" => array ("Product Type",2), 
   "c" => array ("Level",2), 
);
$Aname = explode(",",$menuA[$a]);
$Bname = explode(",",$menuB[$b]);
$Cname = explode(",",$menuC[$c]);
///// EDIT THE NAME OF THE PAGE, AND IF THERE IS ANYTHING YOU WANT ADDED TO THE HEAAD TAG, MAKE IT THE VALUE OF THE $otherHead variable ////
$pageName = "Models";
$name2 = "$Aname[2] Model $Bname[2] $Cname[2]";
$src = "/models/";
$otherHead = "
<meta name=\"description\" content=\"The Oklahoma Weather Lab at the University of Oklahoma produces an extensive 
array of model products from the GFS, ECMWF, NAM, RUC, and our own WRF-ARW model. We strive to present the most accurate and up to date products
of any data site, and we make every effort to make these the most timely model products available to the general public.\" />";
$hideThing = true;
///// MAKE AN ARRAY OF THE LINKS IN THE SIDE MENU, THE KEY IS WHATS WRITTEN, AND THE VALUE IS THE URL OF THE LINK ////

include '../global/virtual/hootTop.php';
include '../global/virtual/sqlcount.php';
$a = str_replace('_','/',$a);

// Check if the $c is among the available product types. if it is not, default to the first product type.

if (strpos($a, "ecmwf") === false) { $arev = substr($a,0,3); }
else {$arev = substr($a,0, 5);}

if (strpos($a, "prev") !== false) {$brev = "prev_";} else {$brev = null;}
if ($c == "adm" && $arev == "wrf") { $c = "ard"; }
if ($b == "fsound") { $crev = strToUpper($c); }

if ($b == "surf" || $b == "sevr") { $crc = "/models_data/$a/${arev}_${c}_${brev}f"; } 
else if ($b == "fsound") { $crc = "/models_data/$a/${arev}_${crev}_fsound_${brev}f"; }
else if ($a == 'wrf' && $b == 'thte') { $crc = "/models_data/$a/${arev}_${b}_${brev}f"; }
else if ($arev == "ecmwf" && $b == "temp") { $crc = "/models_data/$a/${arev}_${b}_pmsl_${brev}f"; }
else { $crc = "/models_data/$a/${arev}_${c}_${b}_${brev}f"; }

if ($arev == "gfs" || $arev == "ecmwf") {$zeros = "000";}
else {$zeros = "00";}

?>
   <!--PAGE CONTENTS -->
<?php 

/// stat array: [0]: length(hrs) [1]:inital spread [2]:hour where ini spread ends [3]: 2nd spread [4]: length
$stats = modelStats($a,$b,$c,$ftime[$a]);

?>


<form name="form" action="">
<input type="hidden" id="fh" name="fh" value="0">
<div id="doNotPrint">
<?php
// $mouseover ="<label><input type=\"checkbox\" name=\"nostep\" checked=\"checked\" />Rollover Times on/off</label>";
 $controlType=2; 
 include '../global/virtual/controls.php'; 
?>
<?php
$ic = 0;
for ($i = 0; $i <= $stats[2]; $i+=$stats[1]) {
   $forecasts[$ic] = sprintf("F%02.0f",$i);
$ic++;
}
for ($i = $stats[2]+$stats[3]; $i <= $stats[0]; $i+=$stats[3]) {
   $forecasts[$ic] = sprintf("F%02.0f",$i);
   $ic++;
}
selectTable($forecasts,true);
?>
</div>
<div class="mapbox">
<?php
  if (file_exists("../$crc$zeros.gif")||file_exists("../$crc$zeros.png")) {
  echo" <img src=\"$crc$zeros.gif\" name=\"animation\" alt=\"Loading...\" ondblclick=\"document.location.href = this.src\" />
  <br />
  Double-click on this frame to see the individual image!";
 } else {
  echo "\n\n<!--../$crc$zeros.gif-->\n\n";
  echo "<br /><br />\n<center>\n<b>This product is not available for this model, please refine your selections.\n </b>\n</center>";
 }
?>
</div>
 
<!--  Delay (ms): <INPUT TYPE=text VALUE="" NAME="delay" SIZE=6> //-->
</form>
<script type="text/javascript">
<!--
var imax = <?echo $stats[4];?>;
window.pauseOnStart = true;
window.pauseWhere = 0;
window.temp_list = new Array(imax);          

<?php
$cindex = 0;
for($count=0;$count<=$stats[2];$count+=$stats[1]) 
{
	echo "window.temp_list[$cindex]= \"$crc";
	if ($a == "gfs" || $a == "gfs/prev" || $a == "ecmwf" || $a == "ecmwf/prev" )
	{
		printf("%03.0f",$count);
	} 
	else 
	{
		printf("%02.0f",$count); 
	}
	echo ".gif\";\n";
	$cindex++;
}

// now do it for the second spread
for($count= $stats[2] + $stats[3]; $count <= $stats[0]; $count += $stats[3]) 
{
	echo "window.temp_list[$cindex]= \"$crc";
	if ($a == "gfs" || $a == "gfs/prev" || $a == "ecmwf" || $a == "ecmwf/prev") 
	{
		printf("%03.0f",$count);
	} else {
		printf("%02.0f",$count); 
	}
	echo ".gif\";\n";
	$cindex++;
}

?>
initialize_looper();

// -->
</script>



<?php 
//} // END OF IF STATMENT REGARDING IF THERE IS A REGION SELECTED
?>

   </div>
<?php
include '../global/virtual/footer.php';
?>
</div>


</body>
</html>
