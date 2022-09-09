<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){

    $parent_id = $_SESSION['id']; 

    $student_id     = $_POST["student_id"];
    $subject = $_POST["subject"];
    $Offer_Salary    = $_POST["Offer_Salary"];

    $tution_days    = $_POST["Student_tution_days"];

    $Student_tution_time_from  = $_POST["Student_tution_time_from"];
    $Student_tution_time_to    = $_POST["Student_tution_time_to"];

    //student 
                             
    $student_query = "SELECT * FROM student WHERE  id='$student_id' ";
    $student_result = mysqli_query($conn, $student_query);
   

    while($student_row = mysqli_fetch_array($student_result))
    {
        $studentname =  $student_row["studentname"];
        $studentclass =  $student_row["studentclass"];
        $studentmedium =  $student_row["medium"];
        $studentgender =  $student_row["studentgender"];
        $studentDistrict =  $student_row["studentDistrict"];
        $studentArea =  $student_row["studentArea"];
        $studentimage =  $student_row["studentimage"];
        
    }

   //student  end

    if($Student_tution_time_from > $Student_tution_time_to){
        $_SESSION['TutionTimeError'] = "from-time-should-not-greater-than-to-time";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php' );
        die();
    }

     // tution days,time exect check

    // day check
    foreach ($tution_days as $tution_day) {
        if($tution_day == 1){
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%1%' ";
        }elseif ($tution_day == 2) {
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%2%' ";
        }elseif ($tution_day == 3) {
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%3%' ";
        }elseif ($tution_day == 4) {
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%4%' ";
        }elseif ($tution_day == 5) {
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%5%' ";
        }elseif ($tution_day == 6) {
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%6%' ";
        }elseif ($tution_day == 7) {
            $query_tution_days_exect = "SELECT * FROM student_info WHERE student_id='$student_id' AND parent_id='$parent_id' AND tution_days LIKE '%7%' ";
        }
              
        $result_tution_days_exect = mysqli_query($conn, $query_tution_days_exect);
        
        while($row_student_days_exect = mysqli_fetch_array($result_tution_days_exect)){
            $student_tution_days_exects      = $row_student_days_exect["tution_days"];
         
            $student_tution_days_exect = explode(',', $student_tution_days_exects);
           
            foreach ($tution_days as $tution_day) {
                foreach ($student_tution_days_exect as $student_tution_day_exect) {
                    if($tution_day == $student_tution_day_exect){

                        // time check
                        $student_tution_times_from_exect = $row_student_days_exect["tution_time_from"];
                        $student_tution_times_to_exect = $row_student_days_exect["tution_time_to"];
                       
                        if($Student_tution_time_from == $student_tution_times_from_exect){
                        
                                $_SESSION['TutionTimeError'] = "tution-time-clash";
                                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php' );
                                die();
                        }elseif($Student_tution_time_to == $student_tution_times_to_exect){
                         
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php' );
                            die();
                        }elseif( ($Student_tution_time_from > $student_tution_times_from_exect) && ($student_tution_times_to_exect > $Student_tution_time_from) ){
                        
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php' );
                            die();
                        }elseif( ($Student_tution_time_to > $student_tution_times_from_exect) && ($Student_tution_time_to < $student_tution_times_to_exect) ){
                           
                                $_SESSION['TutionTimeError'] = "tution-time-clash";
                                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php' );
                                die();
                        }elseif( ($Student_tution_time_from < $student_tution_times_from_exect) && ($Student_tution_time_to > $student_tution_times_to_exect) ){
                          
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php' );
                            die();
                        }
                    // time check end
                         
                       
                    }
                }
            }
        }
    }
    // day check end
                        
    // tution days,time exect check end
    
    
    //student tution days
    $Student_tution_days = '';
    foreach($tution_days as $row)
    {
      $Student_tution_days .= $row . ', ';
    }
      $Student_tution_days = substr($Student_tution_days, 0, -2);
    //student tution days end  
 
  

    if($studentname != null && $student_id != null && $studentclass != null && $studentmedium != null && $subject != null && $studentgender != null 
        && $studentDistrict != null && $studentArea != null && $studentimage != null && $Offer_Salary != null && $Student_tution_days != null
        && $Student_tution_time_from != null && $Student_tution_time_to != null ){
            
            if($conn){
                $sql = " INSERT INTO student_info(id , student_id , parent_id , studentname , studentclass , medium , subject , studentgender , studentDistrict , studentArea , studentimage , Offer_Salary , tution_days, tution_time_from , tution_time_to) VALUES ( '' , '$student_id' , '$parent_id' , '$studentname' , '$studentclass' , '$studentmedium' , '$subject' , '$studentgender' , '$studentDistrict' , '$studentArea' , '$studentimage' , '$Offer_Salary' , '$Student_tution_days' , '$Student_tution_time_from' , '$Student_tution_time_to') ";                 
            
                $result = mysqli_query($conn , $sql);
                // print_r($conn);
                // die();
               
                if($result != null){
                  //  header('location: ../view/login.php?msg=user-registration-completed');
                    header("location: http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php?status=student-tution-add-completed");
                }else{
                    
                    header('location:  http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php?status=somethig-worng' );
                }                        
            }else {
                header('location:  http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php?status=' . "$error"  );
            }    
        
    }else{
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution.php?status=fild-empty');
    }

mysqli_close($conn);

}

?>