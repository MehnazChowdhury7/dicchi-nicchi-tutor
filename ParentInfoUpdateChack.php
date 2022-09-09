<?php
require('db_rw.php');
session_start();

$current_user_email = 0;
$new_email = 0;

if(isset($_POST["submit"])){
    
    $id = $_POST["id"];
    $name     = $_POST["username"];
    $email    = $_POST["email"];
	$mobile    = $_POST["mobile"];
    $parent_status    = $_POST["parent_status"];
   // $password = $_POST["pass"];
   // $password = md5($password); //password hase making
    $a    = $_FILES["image"];
    
    //email validation
    $parent_id = $_SESSION['id']; 
    $sql_user_email = "SELECT email FROM parentregistration WHERE  id='$parent_id' ";
    $result_user_email = mysqli_query($conn , $sql_user_email);

    if($result_user_email->num_rows != null){
		$row = mysqli_fetch_array($result_user_email);
			
           $user_email = $row['email'];
	}

    $sql_email = "SELECT email FROM parentregistration WHERE  email='$email' ";
    $result_email = mysqli_query($conn , $sql_email);

    if($result_email->num_rows != null && $user_email == $email){
	   $current_user_email = "1";
       
	
	}elseif($result_email->num_rows == null){
        $new_email = "1";
    }else{
        header('location: ParentInfoUpdate.php?status=this-email-is-alraedy-taken');
    }
    //email validation end


    if($current_user_email == "1" || $new_email == "1"){

        if($a['size'] != 0){

            $image = $_FILES["image"];
            
            $file_data = explode('.', $image['name']);
            $file_exe = end($file_data);
    
            if($file_exe != "jpg"){
                //die($file_exe);
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/ParentinfoUpdate.php?status=is-not-a-valid-file');
                die();
            }
    
            $old_file_name = $_POST["old_image"];
            unlink('C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/parent/'.$old_file_name);
    
            $file_name = uniqid('PP_' , true) . '.' . $file_exe;
            $file_path = 'C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/parent/' . $file_name;
            
            $upload = move_uploaded_file($image['tmp_name'] , $file_path );
        }else{
            $file_name = $_POST["old_image"];
        }
    
        if($name != null && $email != null  && $mobile != null && $file_name != null && $parent_status != null){
                
                if($conn){
                    $sql = " UPDATE  parentregistration SET username ='$name' , email='$email' , mobile='$mobile' , image='$file_name' , status='$parent_status' where id='$id' "; 
        
                    $result = mysqli_query($conn , $sql);
                   
                    if($result != null){
                        $_SESSION['id'] = $id;
                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php?status=user-update-successfully');
                    }else{
                        
                        $error = mysqli_error($conn);
                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/ParentinfoUpdate.php?status=' . "$error"  );
                    }                        
                }else{   
                    $error = mysqli_error($conn);
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/ParentinfoUpdate.php?status=' . "$error"  );
                } 
    
            }else{
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/ParentinfoUpdate.php?status=fild-empty');
            }
        
    }


mysqli_close($conn);

}

?>