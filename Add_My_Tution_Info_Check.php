<?php
require('db_rw.php');
session_start();

if(isset($_POST["submit"])){

    $TeacherSubject     = $_POST["TeacherSubject"];
    $TeacherClass    = $_POST["TeacherClass"];
	$medium    = $_POST["medium"];
    $Tutor_Salary    = $_POST["Tutor_Salary"];
    $tutor_id = $_SESSION['Tutor_id'];
   
    $tution_days    = $_POST["tutor_tution_days"];

    $Tutor_tution_time_from  = $_POST["Tutor_tution_time_from"];
    $Tutor_tution_time_to    = $_POST["Tutor_tution_time_to"];
    $Tutor_tution_time_from = $Tutor_tution_time_from . (':00');
    $Tutor_tution_time_to = $Tutor_tution_time_to . (':00');

    if($Tutor_tution_time_from > $Tutor_tution_time_to){
        $_SESSION['TutionTimeError'] = "from-time-should-not-greater-than-to-time";
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php' );
        die();
    }

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

            $tutor_tution_days_exect = explode(',', $tutor_tution_days_exects);
           
            foreach ($tution_days as $tution_day) {
                foreach ($tutor_tution_days_exect as $tutor_tution_day_exect) {
                    if($tution_day == $tutor_tution_day_exect){
                     
                        // time check
                        $tutor_tution_times_from_exect = $row_tution_days_exect["tutor_tution_time_from"];
                        $tutor_tution_times_to_exect = $row_tution_days_exect["tutor_tution_time_to"];

                        if($Tutor_tution_time_from == $tutor_tution_times_from_exect){
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php' );
                            die();
                        }elseif($Tutor_tution_time_to == $tutor_tution_times_to_exect){
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php' );
                            die();
                        }elseif( ($Tutor_tution_time_from > $tutor_tution_times_from_exect) && ($tutor_tution_times_to_exect > $Tutor_tution_time_from) ){
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php' );
                            die();
                        }elseif( ($Tutor_tution_time_to > $tutor_tution_times_from_exect) && ($Tutor_tution_time_to < $tutor_tution_times_to_exect) ){
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php' );
                            die();
                        }elseif( ($Tutor_tution_time_from < $tutor_tution_times_from_exect) && ($Tutor_tution_time_to > $tutor_tution_times_to_exect) ){
                            $_SESSION['TutionTimeError'] = "tution-time-clash";
                            header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php' );
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
      $tutor_tution_days .= $row . ', ';
    }
      $tutor_tution_days = substr($tutor_tution_days, 0, -2);
    //tutor tution days end  
  

    if($TeacherSubject != null && $TeacherClass != null && $medium != null && $Tutor_Salary != null && $tutor_id != null && 
       $tutor_tution_days != null && $Tutor_tution_time_from != null && $Tutor_tution_time_to != null ){
  
            
            if($conn){
                $sql = " INSERT INTO tution_info(id , Tutor_id , TeacherSubject , TeacherClass , medium , Tutor_Salary , tutor_tution_days , tutor_tution_time_from , tutor_tution_time_to ) VALUES ( '' , '$tutor_id' , '$TeacherSubject' , '$TeacherClass' , '$medium' , '$Tutor_Salary' , '$tutor_tution_days' , '$Tutor_tution_time_from' , '$Tutor_tution_time_to') ";                 
            
                $result = mysqli_query($conn , $sql);
                // print_r($conn);
                // die();
               
                if($result != null){
                  //  header('location: ../view/login.php?msg=user-registration-completed');
                    header("location: http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php?status=tution-info-add-completed");
                }else{
                    
                    header('location:  http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php?status=somethig-worng' );
                }                        
            }else {
                header('location:  http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php?status=' . "$error"  );
            }    
     
    }else{
        header('location: http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info.php?status=fild-empty');
    }

mysqli_close($conn);

}

?>