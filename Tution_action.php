<?php  
require('db_rw.php');
session_start();

 if($_POST["action"] == "delete"){
    
   $sql = "DELETE FROM tution_info WHERE id = '".$_POST["id"]."'";  
   
   if(mysqli_query($conn, $sql))  
    {  
         echo 'Data Deleted';  
    }

 }if($_POST["action"] == "status_change"){
     
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
      
  
}elseif($_POST["action"] == "Reject"){
   
   $tution_id = $_POST["tution_id"];
   
   $sql = "UPDATE  tution SET status ='5' where id='$tution_id' "; 
    
   $result = mysqli_query($conn , $sql); 
  
   if($result != null)  
    {  
         echo 'Tution Rejected Successfully';  
    }else{
         echo 'Tution not Rejected Successful..... something wrong'; 
    }

}elseif($_POST["action"] == "accept"){

   $tution_id = $_POST["tution_id"];
   
   $sql = "UPDATE  tution SET status ='3' where id='$tution_id' "; 
    
   $result = mysqli_query($conn , $sql); 
  
   if($result != null)  
    {  
         echo 'Tution accepted Successfully';  
    }else{
         echo 'Tution not accepted Successful..... something wrong'; 
    }

}elseif($_POST["action"] == "approved"){

     $tution_id = $_POST["tution_id"];
     
     $sql = "UPDATE  tution SET status ='7'  where id='$tution_id' "; 
      
     $result = mysqli_query($conn , $sql); 
    
     if($result != null)  
      {  
           echo 'Tution approved Successfully';  
      }else{
           echo 'Tution not approved Successful..... something wrong'; 
      }
  
  }elseif($_POST["action"] == "unapproved"){

     $tution_id = $_POST["tution_id"];
     
     $sql = "DELETE FROM tution WHERE id = '$tution_id'"; 
      
     $result = mysqli_query($conn , $sql); 
    
     if($result != null)  
      {  
           echo 'Tution unapproved Successfully';  
      }else{
           echo 'Tution not unapproved Successful..... something wrong'; 
      }
  
  }elseif($_POST["action"] == "Tutor request approved"){

     $tution_id = $_POST["tution_id"];
     
     $sql = "UPDATE  tution SET status ='11'  where id='$tution_id' "; 
      
     $result = mysqli_query($conn , $sql); 
    
     if($result != null)  
      {  
           echo 'Tution approved Successfully';  
      }else{
           echo 'Tution not approved Successful..... something wrong'; 
      }
  
  }elseif($_POST["action"] == "Tutor request unapproved"){

     $tution_id = $_POST["tution_id"];
     
     $sql = "DELETE FROM tution WHERE id = '$tution_id'"; 
      
     $result = mysqli_query($conn , $sql); 
    
     if($result != null)  
      {  
           echo 'Tution unapproved Successfully';  
      }else{
           echo 'Tution not unapproved Successful..... something wrong'; 
      }
  
  }elseif($_POST["action"] == "confirm"){

     $tution_id = $_POST["tution_id"];
     $admin_id = $_POST["admin_id"];
     $started_date = date("y-m-d");
     
     $sql = "UPDATE  tution SET status ='9', approved_by ='$admin_id' , started_date ='$started_date' where id='$tution_id' "; 
      
     $result = mysqli_query($conn , $sql); 
    
     if($result != null)  
      {  
           echo 'Tution confirmed Successfully';  
      }else{
           echo 'Tution not confirmed Successful..... something wrong'; 
      }
  
  }elseif($_POST["action"] == "tution_delete"){

     $tution_id = $_POST["tution_id"];
     
     $sql = "DELETE FROM tution WHERE id = '$tution_id'";  
   
     if(mysqli_query($conn, $sql))  
     {  
          echo 'Data Deleted';  
     }
  
  }


 ?>