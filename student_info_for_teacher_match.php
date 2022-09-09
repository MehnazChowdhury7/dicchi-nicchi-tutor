<?php
require('db_rw.php');

if(isset($_POST["student_id"]))
{
   
    $query = "SELECT * FROM student_info WHERE id = '".$_POST["student_id"]."'";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result))
    {
        $data["Student_image"] = 'upload/student/'.$row["studentimage"];
        
        $data["Student_id"] = $row["id"];
        $data["Student_name"] = $row["studentname"];
  
        $Student_gender = $row["studentgender"];
        $data["Student_class"] = $row["studentclass"];
        $Student_subject = $row["subject"];
        $Student_medium = $row["medium"];

        $Student_district = $row["studentDistrict"];
        $Student_area = $row["studentArea"];

        $student_tution_days  = $row['tution_days'];
        $student_tution_time_from  = $row['tution_time_from'];
        $data["student_tution_time_from"] = date("h:i a",strtotime($student_tution_time_from));
        $student_tution_time_to  = $row['tution_time_to'];
        $data["student_tution_time_to"] = date("h:i a",strtotime($student_tution_time_to));

        $data["Student_offer_salary"] = $row["Offer_Salary"];

            // gender
            $query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
            $result_gender = mysqli_query($conn, $query_gender);
            while($row_gender = mysqli_fetch_array($result_gender))
            {
            $gender_id = $row_gender["id"];
            if($gender_id == $Student_gender){
                $data["Student_gender"]  = $row_gender["gender_name"];
            
            }   
            
            }
            // gender end

            //  subject 
            $query_subject = "SELECT id,subject_name FROM subject ORDER BY id ASC";
            $result_subject = mysqli_query($conn, $query_subject);
            while($row_subject = mysqli_fetch_array($result_subject))
            {
            $subject_id = $row_subject["id"];
            if($subject_id == $Student_subject){
                    $data["Student_subject"] = $row_subject["subject_name"];
                
            }   
            
            }
        // subject end 

        //    medium
            $query_medium = "SELECT id,medium_name FROM medium ORDER BY id ASC";
            $result_medium = mysqli_query($conn, $query_medium);
            while($row_medium = mysqli_fetch_array($result_medium))
            {
            $medium_id = $row_medium["id"];
            if($medium_id ==  $Student_medium){
                $data["Student_medium"] = $row_medium["medium_name"];
                
            }   
            
            }
        // medium end

        //  district
            $query_district = "SELECT id,district_name FROM district ORDER BY id ASC";
            $result_district = mysqli_query($conn, $query_district);
            while($row_district = mysqli_fetch_array($result_district))
            {
            $district_id = $row_district["id"];
            if($district_id == $Student_district){
                $data["Student_district"] = $row_district["district_name"];
            
            }   
            
            }

        // district end

        // area
            $query_area = "SELECT id,area_name FROM area ORDER BY id ASC";
            $result_area = mysqli_query($conn, $query_area);
            while($row_area = mysqli_fetch_array($result_area))
            {
            $area_id = $row_area["id"];
            if($area_id ==  $Student_area){
                $data["Student_area"] = $row_area["area_name"];
            
            }   
            
            }
        // area end

        // tutor tution days
        $student_tution_days = explode(',', $student_tution_days);

        $query_tution_days = "SELECT id,day_name FROM days";
        $result_tution_days = mysqli_query($conn, $query_tution_days);

        $student_tution_day_array = array();

        while($row_tution_days = mysqli_fetch_array($result_tution_days))
        {
            $day_id = $row_tution_days["id"];
            
            foreach ($student_tution_days as $student_tution_day) {
                if($day_id == $student_tution_day){
                    $student_tution_day_name = $row_tution_days["day_name"];
                    
                    array_push($student_tution_day_array, $student_tution_day_name);
                                               
                }
            }       
        } 
        $data["student_tution_days"] = $student_tution_day_array;

           
        // tutor tution days end

        
    }

 echo json_encode($data);
}
?>
