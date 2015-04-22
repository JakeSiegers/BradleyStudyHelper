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
		
    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>Study Help</h1>
                        <h3>Because you can\'t do it yourself</h3>
                        <hr class="intro-divider">
                            <form>
                                <div class="form-group">
                                    <select name="dept" id="dept" class="form-control">
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
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->
		';
		?>
			<script>
				$(function(){
					getDepartments();
				});
				function getDepartments(){
					$.ajax({
						url:"api.php?method=getDepartments",
						type:"POST",
						dataType:"JSON",
						success:function(results){
							$('select[name="section"]').html('');
							$('select[name="class"]').html('');
							for(i in results.departments){
								$('#dept').append("<option value='"+results.departments[i].Abbreviation+"'>"+results.departments[i].LongName+"</option>");
							}
						},
						error:function(){
							alert("Failed to get departments!");
						}
					});
				}
				
				$(".form-control:first").change(function(){
					getCoursesInDepartment($(".form-control:first").val());
				});

				function getCoursesInDepartment(dept){
					$.ajax({
						url:"api.php?method=getCoursesInDepartment&dept="+dept,
						type:"POST",
						dataType:"JSON",
						success:function(results){
							$('select[name="section"]').html('');
							$('select[name="class"]').html('');
							for(i in results.courses){
								$('select[name="class"]').append("<option value='"+results.courses[i].UniqueID+"'>"+results.courses[i].ClassName+"</option>");
							}
						},
						error:function(){
							alert("Failed to get courses!");
						}
					});
				}
				
				$(".form-control").eq(1).change(function(){
					getSectionsInCourse($(".form-control").eq(1).val());
				});
				
				function getSectionsInCourse(course){
					$.ajax({
						url:"api.php?method=getSectionsInCourse&uniqueCourseID="+course,
						type:"POST",
						dataType:"JSON",
						success:function(results){
							$('select[name="section"]').html('');
							for(i in results.sections){
								$('select[name="section"]').append("<option value='"+results.sections[i].Section+"'>"+results.sections[i].Section+"</option>");
							}
						},
						error:function(){
							alert("Failed to get courses!");
						}
					});
				}
			</script>
		<?php
	}

	function getAllDepartments()
	{
		$this->db->query("SELECT * FROM departments");
		$results = $this->db->fetch_all_assoc();
		echo json_encode(array('success' => true, 'departments' => $results));
		return true;
	}

	function getCoursesInDepartment($dept)
	{
		$this->db->query("SELECT * FROM courses WHERE DepartmentAbbreviation=?", array($dept));
		$results = $this->db->fetch_all_assoc();
		echo json_encode(array('success' => true, 'courses' => $results));
		return true;
	}

	function getSectionsInCourse($uniqueCourseID)
	{
		// echo 'alert("Things!");';
		$this->db->query("SELECT * FROM sections WHERE UniqueCourseID=?", array($uniqueCourseID));
		$results = $this->db->fetch_all_assoc();
		// var_dump($results);
		echo json_encode(array('success' => true, 'sections' => $results));
		return true;
	}

}


?>