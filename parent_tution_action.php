<?php  
require('db_rw.php');
session_start();

 if($_POST["action"] == "parent reject"){
   
   $tution_id = $_POST["tution_id"];
   
   $sql = "UPDATE  tution SET status ='6' where id='$tution_id' "; 
    
   $result = mysqli_query($conn , $sql); 
  
   if($result != null)  
    {  
         echo 'Tution Rejected Successfully';  
    }else{
         echo 'Tution not Rejected Successful..... something wrong'; 
    }

}elseif($_POST["action"] == "parent accept"){

   $tution_id = $_POST["tution_id"];
   
   $sql = "UPDATE  tution SET status ='4' where id='$tution_id' "; 
    
   $result = mysqli_query($conn , $sql); 
  
   if($result != null)  
    {  
         echo 'Tution accepted Successfully';  
    }else{
         echo 'Tution not accepted Successful..... something wrong'; 
    }

}


 ?>