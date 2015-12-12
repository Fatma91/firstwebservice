<?php
 ob_start();
 if(!session_start()){
    session_start();
 }
 error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
 global $dbc;
 global $status;
 $host = "localhost";
 $db_name ="smacrs-mse2015";
 $db_user = "root";
 $db_password = "12345";
 try {
     $dbc = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
 }
 catch(PDOException $exception){
    $message = $exception->getMessage();
    $error = array('code'=>1, 'message'=>$message);
    $revalue = array('status'=>false,'error'=>$error);
    echo json_encode($revalue);
    die();
            
 }
?>
