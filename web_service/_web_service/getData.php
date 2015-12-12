<?php
  require_once '../_lib/GetData.php';
  if(isset($_POST["operation"]))
    {
	switch ($_POST["operation"])
        {       
                case 'academicyear':
			if(isset($_POST["inst_id"]))
                        {
                            $instID = $_POST["inst_id"];
                            $academicyear = getData::getCurrentAcademicYear($instID);
                            $academicyear_Json = json_encode($academicyear);
                            echo $academicyear_Json;
			} 
			break;
                case 'departments':
			if(isset($_POST["inst_id"]))
                        {
                            $instID = $_POST["inst_id"];
                            $departments = getData::getDepartments($instID);
                            $departments_Json = json_encode($departments);
                            echo $departments_Json;
			} 
			break;
                        
                case 'departmentyears':
			if((isset($_POST["inst_id"]))&&(isset($_POST["dep_id"]))){
                            $instID = $_POST["inst_id"];
                            $depID = $_POST["dep_id"];
                            $departmentyears = getData::getDepartmentYear($instID,$depID);
                            $departmentyears_Json = json_encode($departmentyears );
                            echo $departmentyears_Json;
			} 
			break;
                    
		case 'groups':
			if((isset($_POST["inst_id"]))&&(isset($_POST["acyear_id"]))&&(isset($_POST["dep_id"]))&&(isset($_POST["dep_year_id"])))
                        {
                            $instID = $_POST["inst_id"];
                            $acyearID = $_POST["acyear_id"];
                            $depID = $_POST["dep_id"];
                            $depYearID = $_POST["dep_year_id"];
                            $returnGroups = getData::getGroups($instID,$acyearID,$depID,$depYearID);
                            $groups_Json = json_encode($returnGroups);
                            echo $groups_Json;
			} 
			break;
                        
                case 'languages':
			$all_languages = getData::getLanguages();
			$all_languages_Json = json_encode($all_languages );
			echo $all_languages_Json;
			break;
                    
		default :
			echo 'No case selected';
			break;
        }
    } 
    
?>