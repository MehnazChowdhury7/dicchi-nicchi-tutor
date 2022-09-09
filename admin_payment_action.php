<?php  
require('db_rw.php');
session_start();

 if($_POST["action"] == "payment approved"){
     $payment_id = $_POST["payment_id"];
     $admin_id = $_POST["admin_id"];
    
     $sql = "UPDATE  parent_tution_payment SET is_admin_approve ='1' , approved_by='$admin_id' where id='$payment_id' "; 
   
   if(mysqli_query($conn, $sql))  
    {  
         echo 'payment appreoved';  
    }

 }elseif($_POST["action"] == "tutor payment approved"){
     $payment_id = $_POST["payment_id"];
     $admin_id = $_POST["admin_id"];
    
     $sql = "UPDATE  tutor_tution_payment SET is_admin_approve ='1' , approved_by='$admin_id' where id='$payment_id' "; 
   
   if(mysqli_query($conn, $sql))  
    {  
         echo 'payment appreoved';  
    }

 }
 
 

 ?>