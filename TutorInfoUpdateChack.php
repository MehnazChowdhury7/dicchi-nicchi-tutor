<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){
    
    $id = $_POST["tutor_id"];
    $name     = $_POST["username"];
    $email    = $_POST["email"];
	$mobile    = $_POST["mobile"];
    $tutor_status    = $_POST["tutor_status"];
    $tutorgender = $_POST["tutorgender"];
    $TutorDistrict   = $_POST["TutorDistrict"];
    $TutorArea = $_POST["TutorArea"];
    $a    = $_FILES["image"];

    //email validation
    $Tutor_id = $_SESSION['Tutor_id']; 
    $sql_user_email = "SELECT email FROM tutorregistration WHERE  id='$Tutor_id' ";
    $result_user_email = mysqli_query($conn , $sql_user_email);

    if($result_user_email->num_rows != null){
		$row = mysqli_fetch_array($result_user_email);
			
           $user_email = $row['email'];
	}

    $sql_email = "SELECT email FROM tutorregistration WHERE  email='$email' ";
    $result_email = mysqli_query($conn , $sql_email);

    if($result_email->num_rows != null && $user_email == $email){
	   $current_user_email = "1";
       
	
	}elseif($result_email->num_rows == null){
        $new_email = "1";
    }else{
        header('location: TutorInfoUpdate.php?status=this-email-is-alraedy-taken');
    }
    //email validation end

    if($current_user_email == "1" || $new_email == "1"){
        if($a['size'] != 0){

            $image = $_FILES["image"];
            
            $file_data = explode('.', $image['name']);
            $file_exe = end($file_data);
    
            if($file_exe != "jpg"){
                //die($file_exe);
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/TutorinfoUpdate.php?status=is-not-a-valid-file');
                die();
            
            }
    
            $old_file_name = $_POST["old_image"];
            unlink('C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/tutor/'.$old_file_name);
    
            $file_name = uniqid('PP_' , true) . '.' . $file_exe;
            $file_path = 'C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/tutor/' . $file_name;
            
            $upload = move_uploaded_file($image['tmp_name'] , $file_path );
        }else{
            $file_name = $_POST["old_image"];
        }
    
        if($name != null && $email != null  && $mobile != null  && $TutorArea != null  && $TutorDistrict != null  && $tutorgender != null && $file_name != null && $tutor_status != null){
            
                    if($conn){
                        $sql = " UPDATE  tutorregistration SET username ='$name' , email='$email' , mobile='$mobile' , image='$file_name' , tutorgender='$tutorgender' , TutorDistrict='$TutorDistrict' , TutorArea='$TutorArea' , status='$tutor_status' where id='$id' "; 
            
                        $result = mysqli_query($conn , $sql);
                    
                        if($result != null){
                          //  $_SESSION['Tutor_id'] = $id;
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php?status=user-update-successfully');
                        }else{
                            
                            $error = mysqli_error($conn);
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/TutorinfoUpdate.php?status=' . "$error"  );
                        }                        
                    }else{   
                        $error = mysqli_error($conn);
                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/TutorinfoUpdate.php?status=' . "$error"  );
                    }
             
    
            }else{
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/TutorinfoUpdate.php?status=fild-empty');
            }

    }


mysqli_close($conn);

}

?>