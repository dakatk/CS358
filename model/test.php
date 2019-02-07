<html>
<?php

import_request_variables('gp');
#if ($a == null) {$a = "wrf"; }
#if ($b == null) {$b = "wind"; }
#if ($c == null) {$c = "500mb"; }

if ($fh = null) {$fh = 0; }

include "operations.php";
$href="/model/wrf/SFC/mslp_temp";
?>
<div class=main>
<body>
<ul class="navbar">
<table class="text1" border="1">
 <font class=text1>
 <tr>
 <td class="compactLinks">
 <strong>WRF</strong>
 </td></tr>
 <tr>
 <td>

  <a href="/model/wrf/SFC/mslp_temp" class="menuA">Current <br> WRF</a>
 </td></tr>
</table>
</div>
<?php
$p = explode("/",$href);

echo $p[1];
echo $menuA
?>
</body>
</html>
