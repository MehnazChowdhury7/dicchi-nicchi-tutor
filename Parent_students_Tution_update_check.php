<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){

    $parent_id = $_SESSION['id']; 
    
    $student_id = $_POST["student_id"];
    $student_info_id = $_POST["student_info_id"];
    $studentname     = $_POST["studentname"];
    $studentclass    = $_POST["studentclass"];
	$medium    = $_POST["medium"];
    $subject = $_POST["subject"];
    $studentgender = $_POST["studentgender"];
    $studentDistrict   = $_POST["studentDistrict"];
    $studentArea = $_POST["studentArea"];
    $Offer_Salary = $_POST["Offer_Salary"];
   
    $tution_days    = $_POST["Student_tution_days"];

    $Student_tution_time_from  = $_POST["Student_tution_time_from"];
    $Student_tution_time_to    = $_POST["Student_tution_time_to"];
//    $Student_tution_time_from = $Student_tution_time_from . (':00');
//    $Student_tution_time_to = $Student_tution_time_to . (':00');
//    print_r($Student_tution_time_from);
//    print_r($Student_tution_time_to);
//    die();

    if($Student_tution_time_from > $Student_tution_time_to){
        $_SESSION['TutionTimeError'] = "from-time-should-not-greater-than-to-time";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
        die();
    }

    //for current time 
   $query_tution_current_time_store = "SELECT * FROM student_info WHERE id='$student_info_id' ";
   $result_tution_current_time_store = mysqli_query($conn, $query_tution_current_time_store);
        
   while($row_tution_current_time_store = mysqli_fetch_array($result_tution_current_time_store)){
        $student_tution_current_time_from = $row_tution_current_time_store["tution_time_from"];
        $student_tution_current_time_to = $row_tution_current_time_store["tution_time_to"];
   }

   $sql_current_time = " UPDATE  student_info SET  tution_time_from = '00:00:00' , tution_time_to = '00:00:00' where id='$student_info_id' ";
   $result_current_time = mysqli_query($conn , $sql_current_time);
    if($result_current_time == null){
        $_SESSION['status'] = "something-worng";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
    }
   //for current time end

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
                           
                              //for current time 
                                $sql_current_time = " UPDATE  student_info SET  tution_time_from = '$student_tution_current_time_from' , tution_time_to = '$student_tution_current_time_to' where id='$student_info_id' ";
                                $result_current_time = mysqli_query($conn , $sql_current_time);
                                    if($result_current_time == null){
                                        $_SESSION['status'] = "something-worng";
                                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                    }
                                //for current time end
                                $_SESSION['TutionTimeError'] = "tution-time-clash";
                                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                die();
                        }elseif($Student_tution_time_to == $student_tution_times_to_exect){
                            
                             //for current time 
                             $sql_current_time = " UPDATE  student_info SET  tution_time_from = '$student_tution_current_time_from' , tution_time_to = '$student_tution_current_time_to' where id='$student_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                            die();
                        }elseif( ($Student_tution_time_from > $student_tution_times_from_exect) && ($student_tution_times_to_exect > $Student_tution_time_from) ){
                            
                             //for current time 
                             $sql_current_time = " UPDATE  student_info SET  tution_time_from = '$student_tution_current_time_from' , tution_time_to = '$student_tution_current_time_to' where id='$student_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                            die();
                        }elseif( ($Student_tution_time_to > $student_tution_times_from_exect) && ($Student_tution_time_to < $student_tution_times_to_exect) ){
                           
                                //for current time 
                                $sql_current_time = " UPDATE  student_info SET  tution_time_from = '$student_tution_current_time_from' , tution_time_to = '$student_tution_current_time_to' where id='$student_info_id' ";
                                $result_current_time = mysqli_query($conn , $sql_current_time);
                                    if($result_current_time == null){
                                        $_SESSION['status'] = "something-worng";
                                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                    }
                                //for current time end
                                $_SESSION['TutionTimeError'] = "tution-time-clash";
                                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                die();
                        }elseif( ($Student_tution_time_from < $student_tution_times_from_exect) && ($Student_tution_time_to > $student_tution_times_to_exect) ){
                          
                             //for current time 
                             $sql_current_time = " UPDATE  student_info SET  tution_time_from = '$student_tution_current_time_from' , tution_time_to = '$student_tution_current_time_to' where id='$student_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?std_info_id='."$student_info_id" );
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
      $Student_tution_days .= $row . ',';
    }
      $Student_tution_days = substr($Student_tution_days, 0, -2);
    //student tution days end


    if($studentname != null && $studentclass != null && $medium != null && $subject != null && $studentgender != null 
          && $studentDistrict != null && $studentArea != null && $Offer_Salary != null && $Student_tution_days != null
          && $Student_tution_time_from != null && $Student_tution_time_to != null){
           

            if($conn){
                $sql = " UPDATE  student_info SET studentname ='$studentname' , studentclass = '$studentclass' , medium = '$medium' , subject = '$subject' , studentgender = '$studentgender' , studentDistrict = '$studentDistrict' , studentArea = '$studentArea' ,
                                  Offer_Salary = '$Offer_Salary' , tution_days = '$Student_tution_days' , tution_days = '$Student_tution_days' , tution_time_from = '$Student_tution_time_from' , tution_time_to = '$Student_tution_time_to' where id='$student_info_id' "; 
    
                $result = mysqli_query($conn , $sql);
           
                if($result != null){
                  //  $_SESSION['id'] = $id;
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_list.php?status=student-update-successfully');
                }else{
                    
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?status=something-worng' );
                }                        
            }else{
                    
                $error = mysqli_error($conn);
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?status=' . "$error"  );
            }    
        
    }else{
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update.php?status=fild-empty');
    }

mysqli_close($conn);

}

?>