<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validAdmin") || isset($_COOKIE['rm']) ){
     
       if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];
        
        $query_parent_tution_payment = "SELECT * FROM parent_tution_payment WHERE is_admin_approve='0' ";  
        $result_parent_tution_payment = mysqli_query($conn, $query_parent_tution_payment);

        $query_tutor_tution_payment = "SELECT * FROM tutor_tution_payment WHERE is_admin_approve='0' ";  
        $result_tutor_tution_payment = mysqli_query($conn, $query_tutor_tution_payment);

       } 

			 
    }else {
        header('location: AdminLogin.php?status=login-first');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];
            echo $status;
		}

//mysqli_close($conn);
?>

<html>
<head>
      <title>Search a tutor</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 

	  
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style> 
.div1 {
    background-image: url(white-wood-texture-background-design_1022-75.jpg);
    text-align: center;
    width: 1330px;
    height: 100px;
    border: 1px solid blue;
    box-sizing: border-box;
	front-colar:white-space;
}

.div2 {
    background-image: url(white-wood-texture-background-design_1022-75.jpg);
    text-align: center;
    width: 1330px;
    height: 70px;    
    padding: 1px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div3 {
    text-align: center;
    width: 10px;
    height: 10px;    
    padding: 5px;
    margin: -50px 620px;
	}   
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}

.button1 {
    
}

.button2:hover {
   
}

.flex-container {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: row-reverse;
    flex-direction: row-reverse;
    width: 1330px;
    height: 350px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 65px;
    height: 350px;
    margin: 2px;
}
.flex-item-2 {
    text-align: center;
    background-color: lightgrey;
    width: 1320px;
    height: 350px;
    margin: 2px;
}

h1 {
   color: black;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
.value{
    text-align:left;
    float:left;
    font-weight: bold;
}
.h2{
    text-align:center;
    float:center;
    font-weight: bold;
}



</style>

</head>
<body>

<div class="div1"><h1>DICCI NICCI TUTOR</h1></div>

<div class="div2">
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
    <?php if(isset($tutor_id)){
       echo '<a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>';
    }elseif (isset($admin_id)) {
        echo '<a href="http://localhost/PHP/dicchi-nicchi-tutor/Adminhome.php" class="button">Admin Home</button></a>';
    } ?>
</div>

<div>

<h2 class="h2">New Payment List</h2>

<div class="flex-container">
  
  <div class="flex-item-1">
      
        <!-- <div id="dataModal" class="modal fade">  
            <div class="modal-dialog">  
                <div class="modal-content">  
                        
                        <div class="modal-header">  
                            <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            <h4 class="modal-title">Tution Details</h4>  
                        </div>  
                        
                        <div class="modal-body" id="tution_detail">  
                        </div>  
                        
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div>
                        
                </div>  
            </div>  
        </div> -->
    
  </div>

 
   <div class="flex-item-2">
       <div class="container" style="width:850px;">   
              
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th >Tution ID</th>
                               <th >Tution Info ID</th>
                               <?php if(isset( $admin_id)){
                                   
                                 echo '<th >Tutor Name</th>';

                               } ?>
                               <th >Studnt Name </th>  
                               <th >Parent Name </th>
                               <th >Class </th>  
                               <th >Subject </th>  
                               <th >Medium </th>     
                               <th >Status</th>  
                               <th style="text-align:center" width="100%">action</th>
                          </tr>  
                          <?php
                          //for tuotr payment
                          if($result_tutor_tution_payment->num_rows != null){
                              
                            while($row_tutor_tution_payment = mysqli_fetch_array($result_tutor_tution_payment))  
                            { 
                                $tution_id = $row_tutor_tution_payment["tution_id"];
                                $query = "SELECT * FROM tution WHERE id='$tution_id' "; 
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                   
                                //tr start
                                  $output = '<tr>';
                                     
                                     // id start
                                     $output .= '<td>';
                                        $output .= $row["id"];       
                                     $output .= '</td>';
                                     // id end

                                    // student Info
                                    $student_info_id = $row["student_id"];
                                       
                                        $query_student_info = "SELECT * FROM student_info WHERE id='$student_info_id'";  
                                        $result_student_info = mysqli_query($conn, $query_student_info);
                                        while($row_student_info = mysqli_fetch_array($result_student_info))  
                                        {
                                                    $student_info_class =     $row_student_info["studentclass"];
                                                    $student_info_subject =     $row_student_info["subject"];
                                                    $student_info_medium =     $row_student_info["medium"];
                                                    $student_info_salary =     $row_student_info["Offer_Salary"];
                                        }
                                    
                                    // student Info end

                                    // tution info id 
                                    $tution_info_id = $row["tution_info_id"];
                                    $output .= '<td>';
                                      $output .= $tution_info_id;       
                                    $output .= '</td>';
                                    // tution info id end 

                                    // tutor name  
                                    
                                      if(isset($admin_id)){
                                        $output .= '<td>';
                                         
                                           $teacher_id = $row["teacher_id"];
                                           $teacher_name = "SELECT * FROM tutorregistration WHERE id='$teacher_id'";
                                           $result_teacher_name = mysqli_query($conn, $teacher_name);
                                            while($row_teacher_name = mysqli_fetch_array($result_teacher_name))  
                                            {
                                                        $teacher_name =     $row_teacher_name["username"];
                                            }
                                            $output .= $teacher_name;
                                        
                                        $output .='</td>';
                                      }
                                    
                                    // tutor name end 

                                    // student info 
                                   
                                        $student_info_id = $row["student_id"];
                                           
                                            $query_student_info = "SELECT * FROM student_info WHERE id='$student_info_id'";  
                                            $result_student_info = mysqli_query($conn, $query_student_info);
                                            while($row_student_info = mysqli_fetch_array($result_student_info))  
                                            {
                                                        $student_name =     $row_student_info["studentname"];
                                                    
                                            }
                
                                    // student info end 

                                        // student name 
                                        $output .= '<td>';
                                            $output .= $student_name; 
                                        $output .= '</td>';
                                        // student name end 

                                    // parent info 
                                        
                                            $parent_info_id = $row["parent_id"];
                                           
                                            $query_parent_info = "SELECT * FROM parentregistration WHERE id='$parent_info_id'";  
                                            $result_parent_info = mysqli_query($conn, $query_parent_info);
                                            while($row_parent_info = mysqli_fetch_array($result_parent_info))  
                                            {
                                                        $parent_name =     $row_parent_info["username"];
                                                    
                                            }
                
                                    // parent info end 
    
                                    // parent name 
                                    $output .= '<td>';
                                       $output .= $parent_name; 
                                    $output .= '</td>';
                                    // preent name end 

                                    // class
                                    $output .= '<td>';
                                               $query_Class = "SELECT class_name FROM class WHERE id='$student_info_class'";  
                                               $result_Class = mysqli_query($conn, $query_Class);
                                               while($row_Class = mysqli_fetch_array($result_Class))  
                                               {
                                                     $output .= $row_Class["class_name"];
                                               }
                                         
                                    $output .= '</td>'; 
                                    // class end 

                                    // subject 
                                    $output .= '<td>';
                                         
                                               $query_sub = "SELECT subject_name FROM subject WHERE id='$student_info_subject'";  
                                               $result_sub = mysqli_query($conn, $query_sub);
                                               while($row_sub = mysqli_fetch_array($result_sub))  
                                               {
                                                     $output .= $row_sub["subject_name"];
                                               }
                                         
                                    $output .= '</td>';
                                    // subject end  

                                    // medium 
                                    $output .= '<td>';
                                            $query_medium= "SELECT medium_name FROM medium WHERE id='$student_info_medium'";  
                                            $result_medium = mysqli_query($conn, $query_medium);
                                            while($row_medium = mysqli_fetch_array($result_medium))  
                                            {
                                                    $output .= $row_medium["medium_name"];
                                            }
                                    $output .= '</td>'; 
                                   //medium end 

                                   // status 
                                   $output .= '<td>'; 
                                   if(isset($admin_id)){
                                     
                                       if ($row["status"] == 4 && $row["tutor_is_pay"] == 1) {
                                           $output .= '<input type="button" value="tutor paid" class="btn btn-xs btn-info "> '; 
                                       }
                                     
                                    }
                                     
                                    $output .= '</td>';  
                                   // status end 

                                   // action 
                                    $output .= '<td>';
                                        
                                      $tution_id = $row["id"];
                                      $output .= '<input type="button" name="view" value="view" id="' .$tution_id. '" class="btn btn-info btn-xs view_data" />'; 

                                      $query_tutor_tution_payment_info = "SELECT * FROM tutor_tution_payment WHERE tution_id='$tution_id'"; 
                                      $result_tutor_tution_payment_info = mysqli_query($conn, $query_tutor_tution_payment_info);
                                   
                                      while($row_result_tutor_tution_payment_info = mysqli_fetch_array($result_tutor_tution_payment_info))  
                                      {
                                                  $payment_id =  $row_result_tutor_tution_payment_info["id"];

                                                  if(isset($admin_id)){
                                                    if($row["status"] == 4 && $row["tutor_is_pay"] == 1){
                                                        $output .= '<input type="hidden" name="admin_id_btn" data-id3="'.$admin_id.'" value="" class="btn btn-xs btn-danger tutor_pay_admin_id"> ';
                                                        $output .= '<input type="button" name="payment_approved_btn" data-id4="'.$payment_id.'" value="tutor payment approved" class="btn btn-xs btn-danger action"> '; 
                                                    }
                                                  
                                                 }
                                                 
                                      }
                             
                                    
                                   $output .= '</td>';  
                                   // action end 
                                   
                                  $output .= '</tr>';
                                //tr end  
                                   
                                   echo $output;
                            } 

                        }
                        //for tutor payment end

                        //for parent payment
                          if($result_parent_tution_payment->num_rows != null){
                              
                            while($row_parent_tution_payment = mysqli_fetch_array($result_parent_tution_payment))  
                            { 
                                $tution_id = $row_parent_tution_payment["tution_id"];
                                $query = "SELECT * FROM tution WHERE id='$tution_id' "; 
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                   
                                //tr start
                                  $output = '<tr>';
                                     
                                     // id start
                                     $output .= '<td>';
                                        $output .= $row["id"];       
                                     $output .= '</td>';
                                     // id end

                                    // Tution Info
                                    $tution_info_id = $row["tution_info_id"];
                                       
                                        $query_tution_info = "SELECT * FROM tution_info WHERE id='$tution_info_id'";  
                                        $result_tution_info = mysqli_query($conn, $query_tution_info);
                                        while($row_tution_info = mysqli_fetch_array($result_tution_info))  
                                        {
                                                    $Tution_info_class =     $row_tution_info["TeacherClass"];
                                                    $Tution_info_subject =     $row_tution_info["TeacherSubject"];
                                                    $Tution_info_medium =     $row_tution_info["medium"];
                                                    $Tution_info_salary =     $row_tution_info["Tutor_Salary"];
                                        }
                                    
                                    // Tution Info end

                                    // tution info id 
                                    $output .= '<td>';
                                      $output .= $tution_info_id;       
                                    $output .= '</td>';
                                    // tution info id end 

                                    // tutor name  
                                    
                                      if(isset($admin_id)){
                                        $output .= '<td>';
                                         
                                           $teacher_id = $row["teacher_id"];
                                           $teacher_name = "SELECT * FROM tutorregistration WHERE id='$teacher_id'";
                                           $result_teacher_name = mysqli_query($conn, $teacher_name);
                                            while($row_teacher_name = mysqli_fetch_array($result_teacher_name))  
                                            {
                                                        $teacher_name =     $row_teacher_name["username"];
                                            }
                                            $output .= $teacher_name;
                                        
                                        $output .='</td>';
                                      }
                                    
                                    // tutor name end 

                                    // student info 
                                   
                                        $student_info_id = $row["student_id"];
                                           
                                            $query_student_info = "SELECT * FROM student_info WHERE id='$student_info_id'";  
                                            $result_student_info = mysqli_query($conn, $query_student_info);
                                            while($row_student_info = mysqli_fetch_array($result_student_info))  
                                            {
                                                        $student_name =     $row_student_info["studentname"];
                                                    
                                            }
                
                                    // student info end 

                                        // student name 
                                        $output .= '<td>';
                                            $output .= $student_name; 
                                        $output .= '</td>';
                                        // student name end 

                                    // parent info 
                                        
                                            $parent_info_id = $row["parent_id"];
                                           
                                            $query_parent_info = "SELECT * FROM parentregistration WHERE id='$parent_info_id'";  
                                            $result_parent_info = mysqli_query($conn, $query_parent_info);
                                            while($row_parent_info = mysqli_fetch_array($result_parent_info))  
                                            {
                                                        $parent_name =     $row_parent_info["username"];
                                                    
                                            }
                
                                    // parent info end 
    
                                    // parent name 
                                    $output .= '<td>';
                                       $output .= $parent_name; 
                                    $output .= '</td>';
                                    // preent name end 

                                    // class
                                    $output .= '<td>';
                                               $query_Class = "SELECT class_name FROM class WHERE id='$Tution_info_class'";  
                                               $result_Class = mysqli_query($conn, $query_Class);
                                               while($row_Class = mysqli_fetch_array($result_Class))  
                                               {
                                                     $output .= $row_Class["class_name"];
                                               }
                                         
                                    $output .= '</td>'; 
                                    // class end 

                                    // subject 
                                    $output .= '<td>';
                                         
                                               $query_sub = "SELECT subject_name FROM subject WHERE id='$Tution_info_subject'";  
                                               $result_sub = mysqli_query($conn, $query_sub);
                                               while($row_sub = mysqli_fetch_array($result_sub))  
                                               {
                                                     $output .= $row_sub["subject_name"];
                                               }
                                         
                                    $output .= '</td>';
                                    // subject end  

                                    // medium 
                                    $output .= '<td>';
                                            $query_medium= "SELECT medium_name FROM medium WHERE id='$Tution_info_medium'";  
                                            $result_medium = mysqli_query($conn, $query_medium);
                                            while($row_medium = mysqli_fetch_array($result_medium))  
                                            {
                                                    $output .= $row_medium["medium_name"];
                                            }
                                    $output .= '</td>'; 
                                   //medium end 

                                   // status 
                                   $output .= '<td>'; 
                                   if(isset($admin_id)){
                                     
                                       if ($row["status"] == 3 && $row["parent_is_pay"] == 1) {
                                           $output .= '<input type="button" value="parent paid" class="btn btn-xs btn-info "> '; 
                                       }
                                     
                                    }
                                     
                                    $output .= '</td>';  
                                   // status end 

                                   // action 
                                    $output .= '<td>';
                                        
                                      $tution_id = $row["id"];
                                      $output .= '<input type="button" name="view" value="view" id="' .$tution_id. '" class="btn btn-info btn-xs view_data" />'; 

                                      $query_parent_tution_payment_info = "SELECT * FROM parent_tution_payment WHERE tution_id='$tution_id'"; 
                                      $result_parent_tution_payment_info = mysqli_query($conn, $query_parent_tution_payment_info);
                                   
                                      while($row_result_parent_tution_payment_info = mysqli_fetch_array($result_parent_tution_payment_info))  
                                      {
                                                  $payment_id =  $row_result_parent_tution_payment_info["id"];

                                                  if(isset($admin_id)){
                                                    if($row["status"] == 3 && $row["parent_is_pay"] == 1){
                                                        $output .= '<input type="hidden" name="admin_id_btn" data-id1="'.$admin_id.'" value="" class="btn btn-xs btn-danger parent_pay_admin_id"> ';
                                                        $output .= '<input type="button" name="payment_approved_btn" data-id2="'.$payment_id.'" value="payment approved" class="btn btn-xs btn-danger action"> '; 
                                                    }
                                                  
                                                 }
                                                 
                                      }
                                      

                                      
                                     
                                    
                                   $output .= '</td>';  
                                   // action end 
                                   
                                  $output .= '</tr>';
                                //tr end  
                                   
                                   echo $output;
                            } 

                        }
                        //for parent payment

                          ?>  
  
                           
                     </table>  
                </div>  

           </div> 
   </div>

</div>




  
    
</div>
</body>
</html>


<script>  
 $(document).ready(function(){ 

    //payment approve
      $(document).on('click', '.action', function(){
           var action_value = $(this).val();
           var current_tr = $(this).closest('tr');
           
           if(action_value == "payment approved"){
               
               var payment_id=$(this).data("id2");
               console.log(payment_id);
               var admin_id = $(".parent_pay_admin_id").data("id1");  
          }if(action_value == "tutor payment approved"){
               
               var payment_id=$(this).data("id4");
               console.log(payment_id);
               var admin_id = $(".tutor_pay_admin_id").data("id3");  
          }
          

           if(confirm("Are you sure you want to " + action_value +  " this tution?"))  
           {  
                $.ajax({  
                     url:"admin_payment_action.php",  
                     method:"POST",  
                     data:{payment_id:payment_id , action:action_value , admin_id:admin_id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          current_tr.remove(); 
                         
                     }  
                });  
           }  
      });
     //payment approve end  

 });  
 </script>