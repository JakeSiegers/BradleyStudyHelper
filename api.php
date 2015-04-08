<?php
	require_once("inc/core.php");
	$bshcore = new BSH_core();
	switch($_GET['method']){
		case'getDepartments':
			$bshcore->getAllDepartments();
			break;
		case'getCoursesInDepartment':
			$bshcore->getCoursesInDepartment($_GET['dept']);
			break;
	}

?>

