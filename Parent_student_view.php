<?php  
require('db_rw.php');
session_start();

 if($_POST["action"] == "view_student"){   

      $output = '';   
      $query = "SELECT * FROM student WHERE id = '".$_POST["student_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {   
          //parent_name
            $Parent_query = "SELECT username FROM parentregistration WHERE id = '".$row["parent_id"]."' ";
            $Parent_query_result = mysqli_query($conn, $Parent_query);

            if($Parent_query_result->num_rows != null){
                $Parent_row = mysqli_fetch_array($Parent_query_result);	
                    $parent_name = $Parent_row['username'];
            }
            //parent_name end

            //medium
            $medium_query = "SELECT medium_name FROM medium WHERE id = '".$row["medium"]."' ";
            $medium_query_result = mysqli_query($conn, $medium_query);

            if($medium_query_result->num_rows != null){
                $mediumt_row = mysqli_fetch_array($medium_query_result);	
                    $medium_name = $mediumt_row['medium_name'];
            }
            //medium end

            //gender
            $gender_query = "SELECT gender_name FROM gender WHERE id = '".$row["studentgender"]."' ";
            $gender_query_result = mysqli_query($conn, $gender_query);

            if($gender_query_result->num_rows != null){
                $gender_row = mysqli_fetch_array($gender_query_result);	
                    $gender_name = $gender_row['gender_name'];
            }
            //gender end

            //subject
            // $subject_query = "SELECT subject_name FROM subject WHERE id = '".$row["subject"]."' ";
            // $subject_query_result = mysqli_query($conn, $subject_query);

            // if($subject_query_result->num_rows != null){
            //     $subject_row = mysqli_fetch_array($subject_query_result);	
            //         $subject_name = $subject_row['subject_name'];
            // }
            //subject end

            //district
            $district_query = "SELECT district_name FROM district WHERE id = '".$row["studentDistrict"]."' ";
            $district_query_result = mysqli_query($conn, $district_query);

            if($district_query_result->num_rows != null){
                $district_row = mysqli_fetch_array($district_query_result);	
                    $district_name = $district_row['district_name'];
            }
            //district end

            //area
            $area_query = "SELECT area_name FROM area WHERE id = '".$row["studentArea"]."' ";
            $area_query_result = mysqli_query($conn, $area_query);

            if($area_query_result->num_rows != null){
                $area_row = mysqli_fetch_array($area_query_result);	
                    $area_name = $area_row['area_name'];
            }
            //area end

            // student tution days
            // $tution_days  = $row['tution_days']; 
            // $tution_days = explode(',', $tution_days);
           // student tution days end

           //tuition time from
        //    $tution_time_from  = $row['tution_time_from'];
        //    $tution_time_from =  date('h:i a ', strtotime($tution_time_from));
           //tuition time from end

           //tuition time to
        //    $tution_time_to  = $row['tution_time_to'];
        //    $tution_time_to =  date('h:i a ', strtotime($tution_time_to));
           //tuition time to end

           $output .= '  
                
                <tr>  
                     <td width="30%"><label>id</label></td>  
                     <td width="70%">'.$row["id"].'</td>  
                </tr> 

                <tr>  
                     <td width="30%"><label>Student Name</label></td>  
                     <td width="70%">'.$row["studentname"].'</td>  
                </tr>

                <tr>  
                    <td width="30%"><label>Student Image</label></td>  
                    <td width="70%"><img src="upload/student/'.$row["studentimage"].'" width="300px" height="100px" /></td>  
                </tr>

                <tr>  
                    <td width="30%"><label>Parent name</label></td>  
                    <td width="70%">'.$parent_name.'</td> 
                </tr>

                <tr>  
                    <td width="30%"><label>Student Class</label></td>  
                    <td width="70%">'.$row["studentclass"].'</td>  
                </tr>

                <tr>  
                    <td width="30%"><label>Medium</label></td>  
                    <td width="70%">'.$medium_name.'</td>  
                </tr> 
                
                '; 


$output  .=     '

                <tr>  
                    <td width="30%"><label>Student Gender</label></td>  
                    <td width="70%">'.$gender_name.'</td>  
                </tr> 

                <tr>  
                    <td width="30%"><label>Student District</label></td>  
                    <td width="70%">'.$district_name.'</td>  
                </tr> 

                <tr>  
                    <td width="30%"><label>Student Area</label></td>  
                    <td width="70%">'.$area_name.'</td>  
                </tr> 

                ';  
      }  
      $output .= "</table></div>";  
      echo $output; 

 }elseif($_POST["action"] == "delete"){
    $sql = "DELETE FROM student WHERE id = '".$_POST["id"]."'";  
    if(mysqli_query($conn, $sql))  
    {  
         echo 'Data Deleted';  
    }
 }elseif($_POST["action"] == "status_change"){
     
    $tution_status = $_POST["value"];
    $student_id = $_POST["student_id"]; 

    if($tution_status == 1){
         $sql = "UPDATE  student SET status ='0' where id='$student_id' ";
    }elseif ($tution_status == 0) {
         $sql = "UPDATE  student SET status ='1' where id='$student_id' ";
    }

    $result = mysqli_query($conn , $sql); 
 
    if($result != null)  
    {  
         echo 'Status change Successfully';  
    }else{
         echo 'Status not change Successful..... something wrong'; 
    } 
}

 ?>