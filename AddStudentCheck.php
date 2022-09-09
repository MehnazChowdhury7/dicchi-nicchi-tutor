<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){

    $parent_id = $_SESSION['id']; 

    $studentname     = $_POST["studentname"];
    $studentclass    = $_POST["studentclass"];
	$medium    = $_POST["medium"];
    $studentgender = $_POST["studentgender"];
    $studentDistrict   = $_POST["studentDistrict"];
    $studentArea = $_POST["studentArea"];
    $image    = $_FILES["studentimage"];


    if($studentname != null && $studentclass != null && $medium != null && $studentgender != null 
        && $studentDistrict != null && $studentArea != null && $image != null  ){   
        
        $file_data = explode('.', $image['name']);
        $file_exe = end($file_data);
        
        // if(!in_array($file_exe , ['jpg'] , true)){
            //die($file_exe);
            if($file_exe != "jpg"){
                //die($file_exe);
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/AddStudent.php?status=is-not-a-valid-file');
                die();
            }
        
       $file_name = uniqid('PP_' , true) . '.' . $file_exe;
       $file_path = 'C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/student/' . $file_name;
       
       $upload = move_uploaded_file($image['tmp_name'] , $file_path );
     

        if($upload){
            
            if($conn){
                $sql = " INSERT INTO student(id , parent_id , studentname , studentclass , medium , studentgender , studentDistrict , studentArea , studentimage ) VALUES ( '' , '$parent_id' , '$studentname' , '$studentclass' , '$medium' , '$studentgender' , '$studentDistrict' , '$studentArea' , '$file_name' ) ";                 
            
                $result = mysqli_query($conn , $sql);
                // print_r($conn);
                // die();
               
                if($result != null){
                  //  header('location: ../view/login.php?msg=user-registration-completed');
                    header("location: http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php?status=student-add-completed");
                }else{
                    
                    header('location:  http://localhost/PHP/dicchi-nicchi-tutor/AddStudent.php?status=somethig-worng' );
                }                        
            }else {
                header('location:  http://localhost/PHP/dicchi-nicchi-tutor/AddStudent.php?status=' . "$error"  );
            }    
        }else{
            header('location:  http://localhost/PHP/dicchi-nicchi-tutor/AddStudent.php?status=file-not-found' );

        }
    }else{
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/AddStudent.php?status=fild-empty');
    }

mysqli_close($conn);

}

?>