<?php

error_reporting(E_ALL);

require_once("inc/core.php");
$bshcore = new BSH_core();
$bshcore->getHeader();
$bshcore->getClassSelector();
$bshcore->getFooter();

?>

