<?php

//fetch_data.php

require('db_rw.php');

if(isset($_POST["action"]))
{
    // $query = "
    //          SELECT * FROM student_info
    //          WHERE status = 1
    //          AND is_admin_approve = 1
    //          ";
    $query = " SELECT  student_info.id, student_info.student_id, student_info.parent_id, student_info.studentname, student_info.studentclass, student_info.medium, student_info.subject, 
                      student_info.studentgender, student_info.studentDistrict, student_info.studentArea, student_info.studentimage, student_info.Offer_Salary,
                      student_info.tution_days, student_info.tution_time_from, student_info.tution_time_to, student_info.status,
                      parentregistration.status, parentregistration.is_admin_approve,
                       student.status, student.is_admin_approve
              FROM student_info student_info, parentregistration parentregistration, student student 
              WHERE student_info.parent_id = parentregistration.id
              AND student.id = student_info.student_id
              AND student_info.status = 1
              AND student.status = 1
              AND student.is_admin_approve = 1
              AND parentregistration.status = 1
              AND parentregistration.is_admin_approve = 1
              ";
    
    // salary
    if(isset($_POST["minimum_salary"], $_POST["maximum_salary"]) && !empty($_POST["minimum_salary"]) && !empty($_POST["maximum_salary"]))
    {
    $query .= "
    AND student_info.Offer_Salary BETWEEN '".$_POST["minimum_salary"]."' AND '".$_POST["maximum_salary"]."'
    ";
    }
    // salary end
    
    //medium
    if(isset($_POST["medium"]))
    {
    $medium_filter = implode("','", $_POST["medium"]);
    $query .= "
    AND student_info.medium IN('".$medium_filter."')
    ";
    }
    //medium end
    
    // subject
    if(isset($_POST["subject"]))
    {
    $subject_filter = implode("','", $_POST["subject"]);
    $query .= "
    AND student_info.subject IN('".$subject_filter."')
    ";
    }
    // subject end
    
    // class
    if(isset($_POST["T_class"]))
    {
    $class_filter = implode("','", $_POST["T_class"]);
    $query .= "
    AND student_info.studentclass IN('".$class_filter."')
    ";
    }
    // class end

    // district
     if(isset($_POST["TutorDistrict"]))
     {
         if(($_POST["TutorDistrict"]) != null){
            $district_filter = $_POST["TutorDistrict"];
            $query .= "
            AND student_info.studentDistrict IN('".$district_filter."')
            ";
         }
     }
    // district end

    // area
    if(isset($_POST["TutorArea"]))
    {
        if(($_POST["TutorArea"]) != null){
           $area_filter = $_POST["TutorArea"];
           $query .= "
           AND student_info.studentArea IN('".$area_filter."')
           ";
        }
    }
   // area end

 

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
  
    $output = '';

         if($total_row > 0)
        {
            foreach($result as $row)
            {   
                $student_info_id =  $row['id'];
                $student_id =  $row['student_id'];
                $student_name = $row['studentname'];
                $student_image = $row['studentimage'];
                $medium = $row['medium'];
                $Student_Subject = $row['subject'];
                $Student_Class = $row['studentclass'];
                $student_District = $row['studentDistrict'];
                $student_Area = $row['studentArea'];
                $parent_offer_salary = $row['Offer_Salary'];

                $student_tution_days  = $row['tution_days'];
                $student_tution_time_from  = $row['tution_time_from'];
                $student_tution_time_from = date("h:i a",strtotime($student_tution_time_from));
                $student_tution_time_to  = $row['tution_time_to'];
                $student_tution_time_to = date("h:i a",strtotime($student_tution_time_to));

                $parent_id =  $row['parent_id'];

                $output .= '
                <div class="col-sm-4 col-lg-4 col-md-4" >
                    <div style="border:1px solid blue; border-radius:5px; padding:16px; margin-bottom:12px; height:550px;">';
                                  
                                   $sql = "SELECT * FROM parentregistration WHERE id='$parent_id' ";
                        
                                    $result_parent = mysqli_query($conn , $sql);
                                    
                                    if($result_parent->num_rows != null){
                                        $row_parent = mysqli_fetch_array($result_parent);
                                            
                                            $parent_id = $row_parent['id'];
                                            $parent_name = $row_parent['username'];	
                                        
                                    }
                    
                    

                    $output .= '
                    <img src="upload/student/'. $student_image .'" alt=""  width="200px" height="200px" >
                    <p align="center"><strong> Student ID : <a href="#">'. $student_id .'</a></strong></p>
                    <p align=""><strong> Student  Name : <a href="#">'. $student_name .'</a></strong></p>
                    <p align=""><strong> Parent  Name : <a href="#">'. $parent_name .'</a></strong></p>

                    <h4 class="text-danger" > Offer Salary :'. $parent_offer_salary .'</h4>';
                    
                    //medium
                    $sql = "SELECT * FROM medium WHERE id='$medium' ";
                        
                    $result_tutor = mysqli_query($conn , $sql);
                    
                    if($result_tutor->num_rows != null){
                        $row_tutor = mysqli_fetch_array($result_tutor);
                            
                            $medium_name = $row_tutor['medium_name'];	
                        
                    }
                    // medium end

                     //subject
                     $sql = "SELECT * FROM subject WHERE id='$Student_Subject' ";
                        
                     $result_tutor = mysqli_query($conn , $sql);
                     
                     if($result_tutor->num_rows != null){
                         $row_tutor = mysqli_fetch_array($result_tutor);
                             
                             $StudentSubject = $row_tutor['subject_name'];	
                         
                     }
                     // subject end

                      //class
                    $sql = "SELECT * FROM class WHERE id='$Student_Class' ";
                        
                    $result_tutor = mysqli_query($conn , $sql);
                    
                    if($result_tutor->num_rows != null){
                        $row_tutor = mysqli_fetch_array($result_tutor);
                            
                            $StudentClass = $row_tutor['class_name'];	
                        
                    }
                    // class end

                    // student tution days
                     $tution_days = explode(',', $student_tution_days);

                     $query_tution_days = "SELECT id,day_name FROM days";
                     $result_tution_days = mysqli_query($conn, $query_tution_days);
                    // student tution days end

                    
                    $output .= '
                    Class : '. $StudentClass .' <br />
                    Subject : '. $StudentSubject .' <br />
                    Medium : '. $medium_name .' </p>
                    <h5 align="center"><strong> Tution Days : </strong></h5>'; 
                    while($row_tution_days = mysqli_fetch_array($result_tution_days))
                    {
                        $day_id = $row_tution_days["id"];
                        
                        foreach ($tution_days as $tution_day) {
                            if($day_id == $tution_day){
                                $output .= $row_tution_days["day_name"];
                                $output .= ', ';
                            }
                        }       
                    } 
                    $output .='<br />
                    <a href="#">Time :</a> '. $student_tution_time_from .' To '. $student_tution_time_to . '</p>
                    
                    <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Teacher_View_Student_Info.php">
                       <input type="hidden" name="parent_id" value="'. $parent_id.'"  />
                       <input type="hidden" name="student_id" value="'. $student_info_id.'"  />
                     
                       <input type="submit" id="'.$student_info_id.'" style="margin-top:5px;" class="btn btn-warning form-control " value="View Detials" /> 
                    </form>

                    </div>

                    

                </div>
                ';
                }
        }
        else
        {
        $output = '<h3>No Data Found</h3>';
        }
        
 echo $output;
}

?>
