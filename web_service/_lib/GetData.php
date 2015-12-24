<?php
$confg = '../_confg/database.php';
if(isset($confg)){
    require_once $confg;
}
else{
    require_once '../_confg/database.php';
}

class getData
{
    
    public static function getCurrentAcademicYear($instid){
        try{
            global $dbc;
            $status = true;
            $sql = $dbc->prepare("SELECT id, display_name, description, start_year, end_year FROM inst_academic_year WHERE (inst_id= '$instid' AND active = '1')");
            $sql->execute();
            $fetch= $sql->fetch(PDO::FETCH_ASSOC);
            $data= $fetch;
            if(!empty($data)){
                $revalue = array('status'=>true,'response'=>$data);
                return $revalue;
            }else{
                $revalue = array('status'=>true,'response'=>'there are no year for this institution');
                return $revalue;
            }     
        }catch (Exception $ex){
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
            
        }        
    }
    public static function getDepartments($instid){
        try{
                global $dbc;
                $status = true;
                $sql = $dbc->prepare("SELECT id, name, description FROM inst_department WHERE inst_id='$instid'");
                $sql->execute();
          while($fetch= $sql->fetch(PDO::FETCH_ASSOC))
         {
                $data[] = $fetch;
         }
         if(!empty($data)){
                $revalue = array('status'=>true,'response'=>$data);
                return $revalue;
            }else{
                $revalue = array('status'=>true,'response'=>'there are no departments for this institution');
                return $revalue;
            }
         } 
        
         catch (Exception $ex)
       {
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
        }
        
    }
    
    public static function getDepartmentYear($instid,$depid){    
        try{
                global $dbc;
                $status = true;
                $sql = $dbc->prepare("SELECT id, display_name, description FROM inst_department_year_ug WHERE (inst_id= '$instid' AND dep_id = '$depid')");
                $sql->execute();
                while($fetch= $sql->fetch(PDO::FETCH_ASSOC)){
                    $data[] = $fetch;
               }
                if(!empty($data)){
                    $revalue = array('status'=>true,'response'=>$data);
                    return $revalue;
                }else{
                   $revalue = array('status'=>true,'response'=>'there are no years');
                   return $revalue;
                }
        }catch (Exception $ex){
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
        }
        
    }
    public static function getGroups($instid,$acyearid,$depid,$depyearid){
        try{
           global $dbc;
           $status = true;
           $sql = $dbc->prepare("SELECT id, display_name,description FROM acyear_group WHERE (inst_id= '$instid' AND dep_id = '$depid' AND acyear_id='$acyearid' AND dep_year_id='$depyearid')");
           $sql->execute();
           while($fetch= $sql->fetch(PDO::FETCH_ASSOC)){
                $data[] = $fetch;
          }
         
         if(!empty($data)){
                $revalue = array('status'=>true,'response'=>$data);
                return $revalue;
            }else{
                $revalue = array('status'=>true,'response'=>'there are no groups');
                return $revalue;
            }
            
        }
        catch (Exception $ex)
       {
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
            
        }
        
        
    }
    
    
    public static function getLanguages(){
        try{
           global $dbc;
           $status = true;
           $sql = $dbc->prepare("SELECT id, name, code FROM lut_language");
           $sql->execute();
          while($fetch= $sql->fetch(PDO::FETCH_ASSOC))
           {
                $data[] = $fetch;
           }
         if(!empty($data)){
                $revalue = array('status'=>true,'response'=>$data);
                return $revalue;
            }else{
                $revalue = array('status'=>true,'response'=>'there are no languages');
                return $revalue;
            }
         } 
        
         catch (Exception $ex)
       {
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
        }
        
    }
    
//    public static function getWeekDays(){}

//    public static function getLectures(){}
    
    public static function getExams($instid,$acyearid,$depid,$depyearid,$groupid,$term,$languageid){
       try{
            global $dbc;
            $status = true;                                                                                                                                                                                                       
            $sql = $dbc->prepare("SELECT e.id, e.exam_date, e.start_time, e.end_time, e.hours_no, c.short_name, l.name FROM ug_acyear_exam_schedule_details e INNER JOIN inst_course_ug c ON e.course_id = c.id "
                    . "INNER JOIN inst_location l ON e.location_id = l.id INNER JOIN ug_acyear_exam_schedule s ON"
                    . " e.id=s.id INNER JOIN inst_course_ug_translation t ON e.course_id =t.course_id INNER JOIN "
                    . "acyear_group g ON e.inst_id=g.inst_id WHERE s.inst_id='$instid' AND s.department_id='$depid' "
                    . "AND s.acyear_id='$acyearid' AND department_year_id='$depyearid' AND s.term='$term' AND"
                    . " t.id='$languageid' AND g.id='$groupid'");
            $sql->execute();
            while($fetch= $sql->fetch(PDO::FETCH_ASSOC))
           {
                $data[] = $fetch;
           }
            if(!empty($data)){
                $revalue = array('status'=>true,'response'=>$data);
                return $revalue;
            }else{
                $revalue = array('status'=>true,'response'=>'there are no exams');
                return $revalue;
            }     
        }catch (Exception $ex){
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
            
        }  
    }
    
//    public static function getAssignments(){}

    public static function getTeachers($instid){
         try{
            global $dbc;
            $status = true;                                                                                                                                                                                                       
            $sql = $dbc->prepare("SELECT id, name, email FROM staff_member WHERE inst_id='$instid'");
            $sql->execute();
            while($fetch= $sql->fetch(PDO::FETCH_ASSOC))
            $data= $fetch;
            if(!empty($data)){
                $revalue = array('status'=>true,'response'=>$data);
                return $revalue;
            }else{
                $revalue = array('status'=>true,'response'=>'there are no teachers');
                return $revalue;
            }     
        }catch (Exception $ex){
            $status = false;
            $message = $ex->message;
            $error = array('code'=>1, 'message'=>$message);
            $revalue = array('status'=>false,'error'=>$error);
            return $revalue;
            
        } 
        
        
    }
    
    
    
    
}
?>