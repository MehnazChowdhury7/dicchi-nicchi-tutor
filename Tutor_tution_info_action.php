<?php  
require('db_rw.php');
session_start();

 if($_POST["action"] == "delete"){
    
   $sql = "DELETE FROM tution_info WHERE id = '".$_POST["id"]."'";  
   
   if(mysqli_query($conn, $sql))  
    {  
         echo 'Data Deleted';  
    }

 }elseif($_POST["action"] == "status_change"){
     
     $tution_status = $_POST["value"];
     $tution_id = $_POST["tution_id"]; 

     if($tution_status == 1){
          $sql = "UPDATE  tution_info SET status ='0' where id='$tution_id' ";
     }elseif ($tution_status == 0) {
          $sql = "UPDATE  tution_info SET status ='1' where id='$tution_id' ";
     }

     $result = mysqli_query($conn , $sql); 
  
     if($result != null)  
     {  
          echo 'Status change Successfully';  
     }else{
          echo 'Status not change Successful..... something wrong'; 
     } 
}

 ?>