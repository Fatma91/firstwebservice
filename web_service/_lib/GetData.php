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
            while($fetch= $sql->fetch(PDO::FETCH_ASSOC))
            $data= $fetch;
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
                $revalue = array('status'=>true,'response'=>'there are no departments');
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
    
    
    
    
}
?>