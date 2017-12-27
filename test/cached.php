<?php
date_default_timezone_set("UTC");

require_once("../src/classes/cached/class.CachedContentInterface.inc.php");
require_once("../src/classes/cached/class.CachedContentReader.inc.php");

$ccr = new CachedContentReader();
print_r($ccr);

$url = "http://localhost/info.php";
echo $ccr->read($url, 1000);
