<?php
error_reporting(E_ALL);

require_once("inc/core.php");
$coreclass = new BSH_core();

$coreclass->getHeader();
$coreclass->getClassSelector();
$coreclass->getFooter();

?>


