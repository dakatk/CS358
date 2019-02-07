<?php

function getLevels($t,$p) {

	// the getLevels 
	$t = substr($t,0,3);
	if ($p == "wind" && !($t == "ecm" || $t == "ecm/prev")) {$levels = array ("850mb","700mb","500mb","300mb","250mb"); }
	elseif ($p == "wind" && ($t =="ecm" || $t == "ecm/prev")) {$levels = array ("850mb", "700mb", "500mb", "200mb"); }
	elseif ($p == "temp" && !($t == "ecm" || $t == "ecm/prev")) {$levels = array ("850mb","700mb","500mb"); }
	elseif ($p == "temp" && ($t == "ecm" || $t == "ecm/prev")) {$levels = array ("850mb");}
	elseif ($p == "rel_hum" && !($t == "ecm" || $t == "ecm/prev")) {$levels = array ("850mb","700mb","500mb");}
	elseif ($p == "rel_hum" && ($t == "ecm" || $t == "ecm/prev")) {$levels = array ("850mb","700mb"); }
	elseif ($p == "vort") {$levels = array ("700mb","500mb"); }
	elseif ($p == "vert_vel" && $t != "gfs" && $t != "wrf") {$levels = array ("925mb","850mb","700mb","500mb");}
	elseif ($p == "vert_vel" && $t == "wrf") {$levels = array ("850mb","700mb","500mb");}
	elseif ($p == "surf" && ($t == "nam" || $t == "nam/prev")) {$levels = array ("pmsl","3hr_precip","3hr_conv_precip","dewp","pwtr");}
	elseif ($p == "surf" && ($t == "gfs" || $t == "gfs/prev")) {$levels = array ("pmsl","dewp","precip", "pwtr");}
	elseif ($p == "surf" && ($t == "wrf")) {$levels = array ("pmsl","dewp","precip");}
	elseif ($p == "surf" && ($t == "ruc" || $t == "ruc/prev")) {$levels = array ("pmsl","dewp","strat_precip","conv_precip","total_precip","pwtr");}
	elseif ($p == "thickness") {$levels = array ("1000_500mb",);}
	elseif ($p == "sevr" && ($t == "gfs")) {$levels = array ("cape","lift","lcl","cinh");}
	elseif ($p == "sevr" && ($t == "ruc")) {$levels = array ("cape","hlcy","lift","lcl","cinh");}
	elseif ($p == "sevr" && ($t == "nam")) {$levels = array ("cape","cinh","lift","hlcy","lcl");}
	elseif ($p == "sevr" && ($t == "wrf")) {$levels = array ("sref","olr","hlcy");}
	elseif ($p == "thte" && $t == "nam") {$levels = array (/*"surf",*/"850mb","700mb");}
	elseif ($p == "thte" && $t != "ruc" && $t != "wrf") {$levels = array ("850mb","700mb");}
	elseif ($p == "thte" && $t == "wrf") {$levels = array ("sfc");}
	elseif ($p == "fsound" && $t != "wrf") {$levels = array ("guy","gag","lts","pnc","oun","adm","tul","mlc");}
	elseif ($p == "fsound" && $t == "wrf") {$levels = array ("oun");}
	else {$levels = array ("na"); }
	
	foreach ($levels as $val) 
	{
		$returnArray[$val] = translateLevels($val);
	}
	return $returnArray;
}


function modelStats ($t,$p,$l,$time=null)
{
	$t = substr($t,0,3);

	/// stat array: [0]: length(hrs) [1]:first spread [2]:hour where first spread ends [3]: 2nd spread [4]: total number of images
	if (($t == "gfs" || $t == "gfs/prev") && $p != "fsound" && $l != "pwtr" && $l != "lift") {$stats = array ("240","6","180","12","36");}
	elseif (($t == "gfs" || $t == "gfs/prev") && ($l == "pwtr" || $l == "lift" || $p == "fsound")) {$stats = array ("120","6","30","6","21");}
	elseif ($t == "wrf" || $t == "wrf/prev") {$stats = array ("72","3","0","3","25");} // the wrf has no 2nd spread,
	elseif ($t == "ruc" || $t == "ruc/prev") {$stats = array ("12","1","6","3","9");}
	elseif ($t == "ecm" || $t == "ecm/prev") {$stats = array ("168","24","0","24","8");}
	elseif ($t == "nam" || $t == "nam/prev") 
	{
		// for the nam, there are 2 possible durations, 48 and 60 hours
		if (($time >= 2 && $time < 8) || ($time >= 14 && $time < 20)) 
		{
	   		$stats = array ("48","3","42","3","17");
		} 
		else 
		{
			$stats = array ("60","3","54","3","21");
		}
	}

	return $stats;
}

function translateLevels($c) 
{
	/// this function gives the written name of the level we are plotting
	// if it is a number (and not a thickness) just plot the number
	if (is_numeric(substr($c,0,3)) && !strpos($c,"_")) 
	{
		$names = array ("$c" => "$c,,$c");
	} 
	else 
	{
		$names = array (
			"pmsl" => "MSLP,,Mean Sea Level Pressure",
			"3hr_precip" => "3h Pcp,,Total 3-hr Precipitation",
			"3hr_conv_precip" => "3h C-Pcp,,Convective 3-hr Precipitation",
			"dewp" => "Dpt,,Dewpoint",
			"pwtr" => "PWTR,,Precipitable Water",
			"precip" => "Precip,,Precipitation",
			"strat_precip" => "S-Precip,,Stratiform Precipitation",
			"conv_precip" => "C-Pcp,,Convective Precipitation",
			"total_precip" => "Pcp Tot,,Total Precipitation",
			"cape" => "CAPE,,CAPE",
                        "sref" => "REFL,,Simulated Composite Reflectivity",
                        "olr"  => "OLR,,Outgoing Longwave Radiation",
			"lift" => "LIFT,,Lifted Index",
			"cinh" => "CINH,,Convective Inhibition (CINH)",
			"lcl" => "LCL,,Lifted Condensation Level",
			"1000_500mb" => "1000-500mb,2,1000-500mb",
			"hlcy" => "HLCY,,Helicity",
			"guy" => "GUY,,Guymon, OK",
			"gag" => "GAG,,Gage, OK",
			"lts" => "LTS,,Altus, OK",
			"pnc" => "PNC,,Ponca City, OK",
			"oun" => "OUN,,Norman, OK",
			"adm" => "ADM,,Ardmore, OK",
			"tul" => "TUL,,Tulsa, OK",
			"mlc" => "MLC,,McAlester, OK",
			"sfc" => "SFC,,Surface",
			"surf" => "SFC,,Surface",
			"na" => "Not Available,2,there has been an error",
		);
	}
	$return = $names[$c];
	return $return;
}

// here we declare what he default level should be for each product type
// when an invalid product is requested, this is what is loaded.
 
  $Cdefault = array (
     "wind" => "500mb",
     "temp" => "850mb",
     "vort" => "700mb",
     "vert_vel" => "850mb",
     "surf" => "pmsl",
     "thte" => "850mb",
     "sevr" => ($a == "wrf" ? "sref" : "cape"),
     "rel_hum" => "850mb",
     "fsound" => "oun",
     "thickness" => "1000_500mb",
   );


function notProducts($t) {
// Returns which products from the lst of all products, a certain model does not produce.
	$t = substr($t,0,3);
	$notProduct = array (
		"gfs" => array ("vert_vel"),
		"ecm" => array ("surf", "sevr", "thickness", "fsound", "thte", "vort" ,"vert_vel"),
		"ruc" => array ("thte"),
		"nam" => array (""),
		"wrf" => array ("thickness"),
	);	
	return $notProduct[$t];
}

// this array is all possible product types for all of our models,
// this is checked by the list of 'notProducts' before being listed
$Boptions = array (
    "wind" => "UA WND,,Upper-Level Wind",
    "temp" => "UA TEMP,,Upper-Level Temp",
    "fsound" => "FSOUND,,Forecast Soundings",
    "vort" => "VORT,,Vorticity",
    "vert_vel" => "VVEL,,Vertical Velocity",
    "surf" => ($c != "pwtr" && strpos($c, "precip") === false ? "SFC,,Surface" : "SFC,,"),
    "thte" => "THTE,,Theta-E",
    "sevr" => "SEVR,,Severe Wx",
    "rel_hum" => "RELH,,Relative Humidity",
    "thickness" => "THICK,,Thickness",
);

// set the menuB array (brown menu) checking the notProducts function
foreach ($Boptions as $key => $value) 
{
	if(!in_array($key,notProducts($a))) 
	{	
		$menuB[$key] = $value; 
	}
}
// check if the selected $b is a valid product type
// if not, then set b to the default for the model,
// and set c to the default level for that product
if (!array_key_exists($b,$menuB)) 
{
	$b = (substr($a,0,3)=="wrf")? "surf":"wind";
	$c = $Cdefault[$b];
}

$menuC = getLevels($a,$b);
?>
