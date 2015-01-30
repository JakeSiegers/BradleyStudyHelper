<?php

require_once('inc/db/pdo_helper.php');

class BSH_core{
	function __construct()
	{
		$this->db = new pdo_helper("dbcreds.php");
	}

	function getHeader()
	{

	}

	function getFooter()
	{

	}

	function getClassSelector()
	{

	}

	function getAllDepartments()
	{

	}

	function getCoursesInDepartment()
	{

	}

	function getSectionsInCourse()
	{

	}

}


?>