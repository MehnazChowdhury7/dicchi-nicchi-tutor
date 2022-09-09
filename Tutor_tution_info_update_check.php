<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){
    
    $tutor_tution_info_id = $_POST["tutor_tution_info_id"];
    $tutor_id = $_POST["tutor_id"];
    $expected_Salary = $_POST["expected_Salary"];
    $Tutorclass = $_POST["Tutorclass"];
    $tutor_medium   = $_POST["tutor_medium"];
    $tutor_subject = $_POST["tutor_subject"];
    
    $tution_days    = $_POST["Tutor_tution_days"];
   // $tution_days = implode(", ",$tution_days);
  
    $Tutor_tution_time_from    = $_POST["Tutor_tution_time_from"];
	$Tutor_tution_time_to    = $_POST["Tutor_tution_time_to"];
   // $Tutor_tution_time_from = $Tutor_tution_time_from . (':00');
   // $Tutor_tution_time_to = $Tutor_tution_time_to . (':00');
   

    if($Tutor_tution_time_from > $Tutor_tution_time_to){
        $_SESSION['TutionTimeError'] = "from-time-should-not-greater-than-to-time";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
        die();
    }

    //for current time 
   $query_tution_current_time_store = "SELECT * FROM tution_info WHERE id='$tutor_tution_info_id' ";
   $result_tution_current_time_store = mysqli_query($conn, $query_tution_current_time_store);
        
   while($row_tution_current_time_store = mysqli_fetch_array($result_tution_current_time_store)){
        $Tutor_tution_current_time_from = $row_tution_current_time_store["tutor_tution_time_from"];
        $Tutor_tution_current_time_to = $row_tution_current_time_store["tutor_tution_time_to"];
   }

   $sql_current_time = " UPDATE  tution_info SET  tutor_tution_time_from = '00:00:00' , tutor_tution_time_to = '00:00:00' where id='$tutor_tution_info_id' ";
   $result_current_time = mysqli_query($conn , $sql_current_time);
    if($result_current_time == null){
        $_SESSION['status'] = "something-worng";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
    }
   //for current time end

    // tution days,time exect check

    // day check
    foreach ($tution_days as $tution_day) {
        if($tution_day == 1){
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%1%' ";
        }elseif ($tution_day == 2) {
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%2%' ";
        }elseif ($tution_day == 3) {
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%3%' ";
        }elseif ($tution_day == 4) {
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%4%' ";
        }elseif ($tution_day == 5) {
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%5%' ";
        }elseif ($tution_day == 6) {
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%6%' ";
        }elseif ($tution_day == 7) {
            $query_tution_days_exect = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id' AND tutor_tution_days LIKE '%7%' ";
        }
              
        $result_tution_days_exect = mysqli_query($conn, $query_tution_days_exect);
        
        while($row_tution_days_exect = mysqli_fetch_array($result_tution_days_exect)){
            $tutor_tution_days_exects      = $row_tution_days_exect["tutor_tution_days"];
          //  $tutor_tution_id_exects      = $row_tution_days_exect["id"];

            $tutor_tution_days_exect = explode(',', $tutor_tution_days_exects);
           
            foreach ($tution_days as $tution_day) {
                foreach ($tutor_tution_days_exect as $tutor_tution_day_exect) {
                    if($tution_day == $tutor_tution_day_exect){

                        // time check
                        $tutor_tution_times_from_exect = $row_tution_days_exect["tutor_tution_time_from"];
                        $tutor_tution_times_to_exect = $row_tution_days_exect["tutor_tution_time_to"];
                        
                       
                        if($Tutor_tution_time_from == $tutor_tution_times_from_exect){
                              //for current time 
                                $sql_current_time = " UPDATE  tution_info SET  tutor_tution_time_from = '$Tutor_tution_current_time_from' , tutor_tution_time_to = '$Tutor_tution_current_time_to' where id='$tutor_tution_info_id' ";
                                $result_current_time = mysqli_query($conn , $sql_current_time);
                                    if($result_current_time == null){
                                        $_SESSION['status'] = "something-worng";
                                        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                                    }
                                //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                            die();
                        }elseif($Tutor_tution_time_to == $tutor_tution_times_to_exect){
                             //for current time 
                             $sql_current_time = " UPDATE  tution_info SET  tutor_tution_time_from = '$Tutor_tution_current_time_from' , tutor_tution_time_to = '$Tutor_tution_current_time_to' where id='$tutor_tution_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                            die();
                        }elseif( ($Tutor_tution_time_from > $tutor_tution_times_from_exect) && ($tutor_tution_times_to_exect > $Tutor_tution_time_from) ){
                             //for current time 
                             $sql_current_time = " UPDATE  tution_info SET  tutor_tution_time_from = '$Tutor_tution_current_time_from' , tutor_tution_time_to = '$Tutor_tution_current_time_to' where id='$tutor_tution_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                            die();
                        }elseif( ($Tutor_tution_time_to > $tutor_tution_times_from_exect) && ($Tutor_tution_time_to < $tutor_tution_times_to_exect) ){
                             //for current time 
                             $sql_current_time = " UPDATE  tution_info SET  tutor_tution_time_from = '$Tutor_tution_current_time_from' , tutor_tution_time_to = '$Tutor_tution_current_time_to' where id='$tutor_tution_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                            die();
                        }elseif( ($Tutor_tution_time_from < $tutor_tution_times_from_exect) && ($Tutor_tution_time_to > $tutor_tution_times_to_exect) ){
                             //for current time 
                             $sql_current_time = " UPDATE  tution_info SET  tutor_tution_time_from = '$Tutor_tution_current_time_from' , tutor_tution_time_to = '$Tutor_tution_current_time_to' where id='$tutor_tution_info_id' ";
                             $result_current_time = mysqli_query($conn , $sql_current_time);
                                 if($result_current_time == null){
                                     $_SESSION['status'] = "something-worng";
                                     header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                                 }
                             //for current time end
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
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

    
    //tutor tution days
    $tutor_tution_days = '';
    foreach($tution_days as $row)
    {
      $tutor_tution_days .= $row . ',';
    }
      $tutor_tution_days = substr($tutor_tution_days, 0, -2);
    //tutor tution days end 


    if($Tutor_tution_time_from != null && $Tutor_tution_time_to != null && $expected_Salary != null && $Tutorclass != null && $tutor_medium != null && $tutor_subject != null && $tutor_tution_days != null){
 
            if($conn){
                $sql = " UPDATE  tution_info SET medium ='$tutor_medium' , TeacherClass = '$Tutorclass' , TeacherSubject = '$tutor_subject' , Tutor_Salary = '$expected_Salary' ,
                         tutor_tution_days = '$tutor_tution_days' , tutor_tution_time_from = '$Tutor_tution_time_from' , tutor_tution_time_to = '$Tutor_tution_time_to'
                         where id='$tutor_tution_info_id' "; 
    
                $result = mysqli_query($conn , $sql);
           
                if($result != null){
                  //  $_SESSION['id'] = $id;
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_all_tution.php?status=tution_info-update-successfully');
                }else{
                    $_SESSION['status'] = "something-worng";
                    header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id" );
                }                        
            }else{
                    
                $error = mysqli_error($conn);
                $_SESSION['status'] = $error;
                header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id"  );
            }    
        
    }else{
        $_SESSION['status'] = "field-empty";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id='."$tutor_tution_info_id");
    }

mysqli_close($conn);

}

?>