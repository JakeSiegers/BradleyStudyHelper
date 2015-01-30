<?php

require_once('inc/db/pdo_helper.php');

class BSH_core{
	function __construct()
	{
		$this->db = new pdo_helper("dbcreds.php");
	}

	function getHeader()
	{
		require_once("inc/template/head.php");
	}

	function getFooter()
	{
		require_once("inc/template/foot.php");
	}

	function getClassSelector()
	{
		echo '
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Bradley Study Helper</h1>
					<form>
						<div class="form-group">
							<select name="dept" class="form-control">
							</select>
						</div>
						<div class="form-group">
							<select name="class" class="form-control">
							</select>
						</div>
						<div class="form-group">
							<select name="section" class="form-control">
							</select>
						</div>
					</form>
				</div>
			</div>
		</div>';

	}

	function getAllDepartments()
	{
		$this->db->query("SELECT * FROM departments");
		$results = $this->db->fetch_all_assoc();
		echo "<pre>"; 
		var_dump($results);
		echo "</pre>";
	}

	function getCoursesInDepartment()
	{

	}

	function getSectionsInCourse()
	{

	}

}


?>