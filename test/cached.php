<?php
require_once("../src/classes/class.CachedContentInterface.inc.php");
require_once("../src/classes/class.CachedContentReader.inc.php");

date_default_timezone_set("UTC");

$ccr = new CachedContentReader();
print_r($ccr);

$url = "http://localhost/info.php";
echo $ccr->read($url, 1000);
