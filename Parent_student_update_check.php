<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){

    
    $student_id = $_POST["student_id"];
    $studentname     = $_POST["studentname"];
    $studentclass    = $_POST["studentclass"];
	$medium    = $_POST["medium"];
   // $subject = $_POST["subject"];
    $studentgender = $_POST["studentgender"];
    $studentDistrict   = $_POST["studentDistrict"];
    $studentArea = $_POST["studentArea"];
   // $Offer_Salary = $_POST["Offer_Salary"];
    $image    = $_FILES["studentimage"];


    if($image['size'] != 0){

        $image = $_FILES["studentimage"];
        
        $file_data = explode('.', $image['name']);
        $file_exe = end($file_data);

        // if(!in_array($file_exe , ['jpg'] , true)){
            //die($file_exe);
            if($file_exe != "jpg"){
                //die($file_exe);
                if(isset($_SESSION['id'])){
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_student_update.php?std_id='."$student_id" );
                    die();
                }elseif (isset($_SESSION['admin_id'])) {
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_student_update.php?std_id='."$student_id" );
                    die();
                }    
              
            }

        $old_file_name = $_POST["old_image"];
        unlink('C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/student/'.$old_file_name);

        $file_name = uniqid('PP_' , true) . '.' . $file_exe;
        $file_path = 'C:/xampp/htdocs/PHP/dicchi-nicchi-tutor/upload/student/' . $file_name;
        
        $upload = move_uploaded_file($image['tmp_name'] , $file_path );
    }else{
        $file_name = $_POST["old_image"];
        
    }

    if($studentname != null && $studentclass != null && $medium != null && $studentgender != null 
          && $studentDistrict != null && $studentArea != null && $file_name != null ){
           

            if($conn){

                //student update
                $sql_student = " UPDATE  student SET  studentname ='$studentname' , studentclass = '$studentclass' , medium = '$medium' , studentgender = '$studentgender' , studentDistrict = '$studentDistrict' , studentArea = '$studentArea' ,
                                 studentimage = '$file_name' where id='$student_id' "; 
    
                $result_student = mysqli_query($conn , $sql_student);
                //student update end

                //student_info update
                $sql = " UPDATE  student_info SET student_id ='$student_id' , studentname ='$studentname' , studentclass = '$studentclass' , medium = '$medium' , studentgender = '$studentgender' , studentDistrict = '$studentDistrict' , studentArea = '$studentArea' ,
                                 studentimage = '$file_name' where student_id='$student_id' "; 
    
                $result = mysqli_query($conn , $sql);
                //student_info update end
           
                if($result != null && $result_student != null){
                  //  $_SESSION['id'] = $id;
                   if(isset($_SESSION['id'])){
                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_All_Student.php?status=student-update-successfully');    
                    }elseif(isset($_SESSION['admin_id'])){
                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Admin_Student_List.php?status=student-update-successfully');     
                    } 
                    
                }else{
                    
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_Student_update.php?status=something-worng' );
                }                        
            }else{
                    
                $error = mysqli_error($conn);
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_Student_update.php?status=' . "$error"  );
            }    
        
    }else{
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_Student_update.php?status=fild-empty');
    }

mysqli_close($conn);

}

?>