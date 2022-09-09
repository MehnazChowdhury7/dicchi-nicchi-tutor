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

    $sql_email = "SELECT email FROM parentregistration WHERE email='$email'";
    $result_email = mysqli_query($conn , $sql_email);

    if($result_email->num_rows != null){
        
        header('location: ParentRegistration.php?status=this-email-is-alraedy-taken');
    }else{
        if($name != null && $email != null && $password != null && $mobile != null && $image['size'] != 0){
        
            $file_data = explode('.', $image['name']);
            $file_exe = end($file_data);
            
            // if(!in_array($file_exe , ['jpg'] , true)){
                if($file_exe != "jpg"){
                    //die($file_exe);
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/ParentRegistration.php?status=is-not-a-valid-file');
                    die();
               }
         
           $file_name = uniqid('PP_' , true) . '.' . $file_exe;
           $file_path = 'C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/parent/' . $file_name;
            
           $upload = move_uploaded_file($image['tmp_name'] , $file_path );
    
            if($upload){
                
                if($conn){
                    $sql = " INSERT INTO ParentRegistration(id , username , email , password , mobile , image ) VALUES ( '' , '$name' , '$email' , '$password' , '$mobile' , '$file_name' ) ";                 
        
                    $result = mysqli_query($conn , $sql);
                   
                    if($result != null){
                      //  header('location: ../view/login.php?msg=user-registration-completed');
                        header("location: ParentLogin.php?status=user-registration-completed");
                    }else{
                        
                        header('location:  http://localhost/PHP/dicchi-nicchi-tutor/ParentRegistration.php?status=file-not-found' );
                    }                        
                }else {
                    header('location:  http://localhost/PHP/dicchi-nicchi-tutor/ParentRegistration.php?status=' . "$error"  );
                }    
            }else{
                header('location:  http://localhost/PHP/dicchi-nicchi-tutor/ParentRegistration.php?status=file-not-found' );
    
            }
        }else{
            header('location: http://localhost/PHP/dicchi-nicchi-tutor/ParentRegistration.php?status=fild-empty');
        }

    }
    

mysqli_close($conn);

}

?>