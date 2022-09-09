<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){

    $parent_id     = $_POST["parent_id"];
    $student_id    = $_POST["student_id"];
	$tutor_id    = $_POST["tutor_id"];
    $tution_info_id = $_POST["tution_info_id"];
    $status = 1;
  
  

    if($parent_id != null && $student_id != null && $tutor_id != null && $tution_info_id != null ){

        $sql_tution_existin_check = "SELECT * FROM tution WHERE  parent_id='$parent_id' AND student_id='$student_id' AND teacher_id='$tutor_id' AND tution_info_id='$tution_info_id'   ";
        $tution_existin_check_result = mysqli_query($conn , $sql_tution_existin_check);
            if($tution_existin_check_result->num_rows == 0){
                
                if($conn){
                    $sql = " INSERT INTO tution(id , parent_id , teacher_id , student_id , tution_info_id , status ) VALUES ( '' , '$parent_id' , '$tutor_id' , '$student_id' , '$tution_info_id' , '$status' ) ";                 
                
                    $result = mysqli_query($conn , $sql);
                
                    if($result != null){
                        $_SESSION['tutor_id'] = $tutor_id;
                      
                        header("location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_View_Teacher_Info.php?status=Tution-Request-Completed");
                    }else{
                        
                        header('location:  http://localhost/PHP/dicchi-nicchi-tutor/Parent_View_Teacher_Info.php?status=somethig-worng' );
                    }                        
                }else {
                    header('location:  http://localhost/PHP/dicchi-nicchi-tutor/Parent_View_Teacher_Info.php?status=' . "$error"  );
                }

            }else{
                $_SESSION['tutor_id'] = $tutor_id;
                      
                header("location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_View_Teacher_Info.php?status=Already-Requested");
            }

       
     
    }else{
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_View_Teacher_Info.php?status=fild-empty');
    }

mysqli_close($conn);

}

?>