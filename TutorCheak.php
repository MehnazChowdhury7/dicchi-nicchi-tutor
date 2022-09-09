<?php

//fetch_data.php

require('db_rw.php');

if(isset($_POST["action"]))
{
    $query = "
             SELECT tution_info.tutor_id, tution_info.status, tution_info.Tutor_Salary, tution_info.medium, tution_info.TeacherSubject, tution_info.TeacherClass,
                    tution_info.tutor_tution_days, tution_info.tutor_tution_time_from, tution_info.tutor_tution_time_to, 
                    tutorregistration.status, tutorregistration.TutorDistrict, tutorregistration.TutorArea, tutorregistration.is_admin_approve
             FROM tution_info tution_info, tutorregistration tutorregistration 
             WHERE tution_info.tutor_id = tutorregistration.id
             AND tution_info.status = 1
             AND tutorregistration.status = 1
             AND tutorregistration.is_admin_approve = 1
             ";

//  $query = "
//   SELECT * FROM tution_info where status = '1' 
//  ";
    
    // salary
    if(isset($_POST["minimum_salary"], $_POST["maximum_salary"]) && !empty($_POST["minimum_salary"]) && !empty($_POST["maximum_salary"]))
    {
    $query .= "
    AND tution_info.Tutor_Salary BETWEEN '".$_POST["minimum_salary"]."' AND '".$_POST["maximum_salary"]."'
    ";
    }
    // salary end
    
    //medium
    if(isset($_POST["medium"]))
    {
    $medium_filter = implode("','", $_POST["medium"]);
    $query .= "
    AND tution_info.medium IN('".$medium_filter."')
    ";
    }
    //medium end
    
    // subject
    if(isset($_POST["subject"]))
    {
    $subject_filter = implode("','", $_POST["subject"]);
    $query .= "
    AND tution_info.TeacherSubject IN('".$subject_filter."')
    ";
    }
    // subject end
    
    // class
    if(isset($_POST["T_class"]))
    {
    $class_filter = implode("','", $_POST["T_class"]);
    $query .= "
    AND tution_info.TeacherClass IN('".$class_filter."')
    ";
    }
    // class end

    // district
     if(isset($_POST["StudentDistrict"]))
     {
         if(($_POST["StudentDistrict"]) != null){
            $district_filter = $_POST["StudentDistrict"];
            $query .= "
            AND tutorregistration.TutorDistrict IN('".$district_filter."')
            ";
         }
     }
    // district end

    // area
    if(isset($_POST["StudentArea"]))
    {
        if(($_POST["StudentArea"]) != null){
           $area_filter = $_POST["StudentArea"];
           $query .= "
           AND tutorregistration.TutorArea IN('".$area_filter."')
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
                $tutor_id =  $row['tutor_id'];
                $medium = $row['medium'];
                $TeacherSubject = $row['TeacherSubject'];
                $TeacherClass = $row['TeacherClass'];
                $tutor_tution_days  = $row['tutor_tution_days'];
                $tutor_tution_time_from  = $row['tutor_tution_time_from'];
                $tutor_tution_time_from = date("h:i a",strtotime($tutor_tution_time_from));
                $tutor_tution_time_to  = $row['tutor_tution_time_to'];
                $tutor_tution_time_to = date("h:i a",strtotime($tutor_tution_time_to));
            
                $output .= '
                <div class="col-sm-4 col-lg-4 col-md-4" >
                    <div style="border:1px solid blue; border-radius:5px; padding:16px; margin-bottom:12px; height:510px;">'; 
                                  
                                   $sql = "SELECT * FROM tutorregistration WHERE id='$tutor_id' ";
                        
                                    $result_tutor = mysqli_query($conn , $sql);
                                    
                                    if($result_tutor->num_rows != null){
                                        $row_tutor = mysqli_fetch_array($result_tutor);
                                            
                                            $tutor_id = $row_tutor['id'];
                                            $tutor_name = $row_tutor['username'];
                                            $tutor_email = $row_tutor['email'];
                                            $tutor_mobile = $row_tutor['mobile'];
                                            $tutor_image = $row_tutor['image'];	
                                        
                                    }
                    
                    

                    $output .= '
                    <img src="upload/tutor/'. $tutor_image .'" alt=""  width="200px" height="200px" >
                    <p align="center"><strong> Tutor ID : <a href="#">'. $tutor_id .'</a></strong></p>
                    <p align=""><strong>  Name : <a href="#">'. $tutor_name .'</a></strong></p>
                    <h4 class="text-danger" > Expected Salary :'. $row['Tutor_Salary'] .'</h4>';
                    
                    //medium
                    $sql = "SELECT * FROM medium WHERE id='$medium' ";
                        
                    $result_tutor = mysqli_query($conn , $sql);
                    
                    if($result_tutor->num_rows != null){
                        $row_tutor = mysqli_fetch_array($result_tutor);
                            
                            $medium_name = $row_tutor['medium_name'];	
                        
                    }
                    // medium end

                     //subject
                     $sql = "SELECT * FROM subject WHERE id='$TeacherSubject' ";
                        
                     $result_tutor = mysqli_query($conn , $sql);
                     
                     if($result_tutor->num_rows != null){
                         $row_tutor = mysqli_fetch_array($result_tutor);
                             
                             $TeacherSubject = $row_tutor['subject_name'];	
                         
                     }
                     // subject end

                      //class
                    $sql = "SELECT * FROM class WHERE id='$TeacherClass' ";
                        
                    $result_tutor = mysqli_query($conn , $sql);
                    
                    if($result_tutor->num_rows != null){
                        $row_tutor = mysqli_fetch_array($result_tutor);
                            
                            $TeacherClass = $row_tutor['class_name'];	
                        
                    }
                    // class end

                    // tutor tution days
                    $tution_days = explode(',', $tutor_tution_days);

                    $query_tution_days = "SELECT id,day_name FROM days";
                    $result_tution_days = mysqli_query($conn, $query_tution_days);
                    // tutor tution days end

                    
                    $output .= '
                    Class : '. $TeacherClass .' <br />
                    Subject : '. $TeacherSubject .' <br />
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
                    <a href="#">Time :</a> '. $tutor_tution_time_from .' To '. $tutor_tution_time_to . '</p>
                    
                    <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Parent_View_Teacher_Info.php">
                       <input type="hidden" name="tutor_id" value="'. $row["tutor_id"].'"  />
                       <input type="hidden" name="tutor_class" value="'. $row["TeacherClass"].'"  />
                       <input type="hidden" name="tutor_subject" value="'. $row["TeacherSubject"].'"  />
                       <input type="hidden" name="tutor_medium" value="'. $row["medium"].'"  />
                      
                       <input type="hidden" name="tutor_tution_days" value="'. $tutor_tution_days.'"  />
                       <input type="hidden" name="tutor_tution_time_from" value="'. $row['tutor_tution_time_from'].'"  />
                       <input type="hidden" name="tutor_tution_time_to" value="'. $row['tutor_tution_time_to'].'"  />
                       
                       <input type="submit" id="'. $row["tutor_id"].'" style="margin-top:5px;" class="btn btn-warning form-control " value="View Detials" /> 
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
