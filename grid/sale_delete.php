<?php
include("dbconfig.php");

$dump = print_r($_REQUEST, true);
$fp = fopen("grid_post.log", "w");
fwrite($fp, $dump);
fclose($fp);

?>
