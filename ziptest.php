<?php  
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | Filname:                                                             |
// +----------------------------------------------------------------------+
// | Copyright (c) http://www.sanisoft.com                                |
// +----------------------------------------------------------------------+
// | Description:                                                         |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id$
include_once ("db_mysql.inc");
include_once ("phpZipLocator.php");

$db = new db_sql;

$zipLoc = new zipLocator;

$zipOne = 12345;
$zipTwo = 23456;

$distance = $zipLoc->distance($zipOne,$zipTwo);

echo "The distance between $zipOne and $zipTwo is $distance Miles<br>";

$radius = 20;
$zipArray = $zipLoc->inradius($zipOne,$radius);

echo "There are ",count($zipArray)." Zip codes within $radius Miles of $zipOne";

?>