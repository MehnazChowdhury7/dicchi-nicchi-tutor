<?php

require('db_rw.php');
session_start();

if(isset($_POST["action"]))
{
 $output = '';

 if($_POST["action"] == "studentDistrict")
 {
    $s_id = $_POST["student_id"];
    $sql_stu =  "SELECT * FROM student WHERE  id='$s_id' AND status=1 AND is_admin_approve=1 ";
            
    $result_stu = mysqli_query($conn , $sql_stu);

    if($result_stu->num_rows != null){
        $row_stu = mysqli_fetch_array($result_stu);
            
            $studentArea = $row_stu['studentArea'];	        
    }

     $query_area = "SELECT id,area_name FROM area WHERE d_id = '".$_POST["query"]."' ";
     $result_area = mysqli_query($conn, $query_area);

     $output .= '<option value="">Select one area</option>';
        while($row_area = mysqli_fetch_array($result_area))
        {  
            $Area = $row_area["id"];
            if($studentArea == $Area){
                $output .= '<option value="'.$row_area["id"].'" selected="selected" >'.$row_area["area_name"].'</option>';
              }else{
                $output .= '<option value="'.$row_area["id"].'">'.$row_area["area_name"].'</option>';
              }
            
        }

    }elseif($_POST["action"] == "studentTutionDistrict"){
       $s_info_id = $_POST["student_info_id"];
       $sql_stu_info =  "SELECT * FROM student_info WHERE  id='$s_info_id' AND  status=1 ";
               
       $result_stu_info = mysqli_query($conn , $sql_stu_info);
   
       if($result_stu_info->num_rows != null){
           $row_stu_info = mysqli_fetch_array($result_stu_info);
               
               $studentArea = $row_stu_info['studentArea'];	        
       }
   
        $query_area = "SELECT id,area_name FROM area WHERE d_id = '".$_POST["query"]."' ";
        $result_area = mysqli_query($conn, $query_area);
   
        $output .= '<option value="">Select one area</option>';
           while($row_area = mysqli_fetch_array($result_area))
           {  
               $Area = $row_area["id"];
               if($studentArea == $Area){
                   $output .= '<option value="'.$row_area["id"].'" selected="selected" >'.$row_area["area_name"].'</option>';
                 }else{
                   $output .= '<option value="'.$row_area["id"].'">'.$row_area["area_name"].'</option>';
                 }
               
           }
   
     }elseif($_POST["action"] == "tutorDistrict"){
        $t_id = $_POST["tutor_id"];
        $sql_tut =  "SELECT * FROM tutorregistration WHERE  id='$t_id' ";
                
        $result_tut = mysqli_query($conn , $sql_tut);

        if($result_tut->num_rows != null){
            $row_tut = mysqli_fetch_array($result_tut);
                
                $TutorArea = $row_tut['TutorArea'];	        
        }

        $query_area = "SELECT id,area_name FROM area WHERE d_id = '".$_POST["query"]."' ";
        $result_area = mysqli_query($conn, $query_area);

        $output .= '<option value="">Select one area</option>';
            while($row_area = mysqli_fetch_array($result_area))
            {  
                $Area = $row_area["id"];
                if($TutorArea == $Area){
                    $output .= '<option value="'.$row_area["id"].'" selected="selected" >'.$row_area["area_name"].'</option>';
                  }else{
                    $output .= '<option value="'.$row_area["id"].'">'.$row_area["area_name"].'</option>';
                  }
                
            }

    }elseif($_POST["action"] == "AllDistrict"){

      $query_area = "SELECT id,area_name FROM area WHERE d_id = '".$_POST["query"]."' ";
      $result_area = mysqli_query($conn, $query_area);

      $output .= '<option value="">Select one area</option>';
          while($row_area = mysqli_fetch_array($result_area))
          { 
                  $output .= '<option value="'.$row_area["id"].'">'.$row_area["area_name"].'</option>';
              
          }

    }elseif($_POST["action"] == "studentDistrict_filter"){
         $query_area = "SELECT id,area_name FROM area WHERE d_id = '".$_POST["query"]."' ";
         $result_area = mysqli_query($conn, $query_area);

        //student Area
         $parent_id = $_SESSION['id'];

          $query = "SELECT studentArea FROM student_info WHERE parent_id='$parent_id'";  
          $result = mysqli_query($conn, $query);
        //student Area end

          $student_area_id = array();

          while($row = mysqli_fetch_array($result))  
          { 
                    if(  !in_array($row['studentArea'], $student_area_id) )
                      {
                          array_push($student_area_id, $row['studentArea']);
                      }     
          } 

         $output = '';
         $output .= ' <option value="">Select one area</option>';

              while($row_area = mysqli_fetch_array($result_area))
              { 
                    $row_area_id = $row_area["id"];
                    foreach($student_area_id as $std_area_id){
                      if($row_area_id == $std_area_id){
                        $output .= '<option value="'.$row_area["id"].'">'.$row_area["area_name"].'</option>';
                      }

                    }      
              }    
   
    }elseif($_POST["action"] == "TutorDistrict_filter"){
      $query_area = "SELECT id,area_name FROM area WHERE d_id = '".$_POST["query"]."' ";
      $result_area = mysqli_query($conn, $query_area);


     //student Area
       $tutor_id = $_SESSION['Tutor_id'];

       $query = "SELECT TutorArea FROM tutorregistration WHERE id='$tutor_id'";  
       $result = mysqli_query($conn, $query);
     //student Area end

      // $tutor_area_id = array();

       while($row = mysqli_fetch_array($result))  
       {     
              $TutorArea  = $row['TutorArea'];        
       } 

      $output = '';
      $output .= ' <option value="">Select one area</option>';

           while($row_area = mysqli_fetch_array($result_area))
           { 
                 $row_area_id = $row_area["id"];
                
                   if($row_area_id == $TutorArea){
                     $output .= '<option value="'.$row_area["id"].'">'.$row_area["area_name"].'</option>';
                   }
     
           }    

     }  

      echo $output;
   }

?>