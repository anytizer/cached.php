<?php
require_once("classes/class.CachedContentInterface.inc.php");
require_once("classes/class.CachedContentReader.inc.php");

date_default_timezone_set("UTC");

$ccr = new CachedContentReader();
print_r($ccr);

#$url = "https://raw.githubusercontent.com/anytizer/hosted-content-importer.wp/master/inspirations.md";
$url = "http://localhost/info.php";
echo $ccr->read("file.txt", $url, 1000);
