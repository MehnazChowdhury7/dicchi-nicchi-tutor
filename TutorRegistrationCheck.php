<?php
require('db_rw.php');

if(isset($_POST["submit"])){

    $name     = $_POST["username"];
    $email    = $_POST["email"];
	$mobile    = $_POST["mobile"];
    $password = $_POST["pass"];
    $password = md5($password); //password hase making
    // $gender   = $_POST["gender"];
    $image    = $_FILES["image"];
    $tutorgender = $_POST["tutorgender"];
    $TutorDistrict   = $_POST["TutorDistrict"];
    $TutorArea = $_POST["TutorArea"];

    $sql_email = "SELECT email FROM tutorregistration WHERE email='$email'";
    $result_email = mysqli_query($conn , $sql_email);

    if($result_email->num_rows != null){
        
          header('location: TutorRegistration.php?status=this-email-is-alraedy-taken');
      }else{
          
        if($name != null && $email != null && $password != null && $mobile != null && $tutorgender != null && $TutorDistrict != null && $TutorArea != null && $image['size'] != 0){
        
            $file_data = explode('.', $image['name']);
            $file_exe = end($file_data);
        
            // if(!in_array($file_exe , ['jpg'] , true)){
                if($file_exe != "jpg"){
               // die($file_exe);
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/TutorRegistration.php?status=is-not-a-valid-file');
                die();
            }
            
           $file_name = uniqid('PP_' , true) . '.' . $file_exe;
           $file_path = 'C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/tutor/' . $file_name;
                
            $upload = move_uploaded_file($image['tmp_name'] , $file_path );
            
            if($upload){
                
                if($conn){
                    $sql = " INSERT INTO tutorregistration(id , username , email , password , mobile , image , tutorgender , TutorDistrict , TutorArea ) VALUES ( '' , '$name' , '$email' , '$password' , '$mobile' , '$file_name' ,  '$tutorgender' , '$TutorDistrict' , '$TutorArea' ) ";                 
        
                    $result = mysqli_query($conn , $sql);
                   
                    if($result != null){
                      //  header('location: ../view/login.php?msg=user-registration-completed');
                        header("location: TutorLogin.php");
                    }else{
                        
                        header('location:  http://localhost/PHP/dicchi-nicchi-tutor/TutorRegistration.php?status=something-worng' );
                    }                        
                }    
            }else{
                header('location:  http://localhost/PHP/dicchi-nicchi-tutor/TutorRegistration.php?status=file-not-found'  );
    
            }
        }else{
            header('location: http://localhost/PHP/dicchi-nicchi-tutor/TutorRegistration.php?status=fild-empty');
        }
      }

    

mysqli_close($conn);

}

?>