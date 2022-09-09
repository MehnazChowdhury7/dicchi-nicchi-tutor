<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validParent") || isset($_COOKIE['rm']) ){
     
        $parent_id = $_SESSION['id']; 
	   //all teacher
                $query = "SELECT * FROM tution WHERE parent_id='$parent_id' AND status='9' ";  
                $result = mysqli_query($conn, $query);
        //all teache end

			 
    }else {
        header('location: TutorLogin.php?status=login-first');
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
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php" class="button">Parent Home</button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">All Teachers List</h2>

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
       <div class="container" style="width:1000px;">   
              
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th >Tution ID</th>
                               <th >Student ID</th>
                               <th >Studnt Name </th>  
                               <th >Teache Name </th>
                               <th >Class </th>  
                               <th >Subject </th>  
                               <th >Medium </th>
                               <th >Days </th> 
                               <th >Time </th>     
                               <th >Start date</th>
                               <th >Status</th>  
                               <th style="text-align:center" width="10%">action</th>
                               <th> Approved By </th>
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["id"]; ?></td>
                               
                                
                                <!-- student info -->
                                <?php
                                        $student_info_id = $row["student_id"];
                                       
                                        $query_student_info = "SELECT * FROM student_info WHERE id='$student_info_id'";  
                                        $result_student_info = mysqli_query($conn, $query_student_info);
                                        while($row_student_info = mysqli_fetch_array($result_student_info))  
                                        {
                                             
                                                    $student_name = $row_student_info["studentname"];

                                                    $student_tution_days = $row_student_info["tution_days"];
                                                    $student_tution_time_from = $row_student_info["tution_time_from"];
                                                    $student_tution_time_to = $row_student_info["tution_time_to"];
                                                
                                        }
            
                                ?>
                                <!-- student info end -->

                                <!-- student  id -->
                                <td><?php echo $student_info_id; ?></td>
                                <!-- student  id end -->

                                <!-- student name -->
                                <td><?php echo $student_name; ?></td>
                                <!-- student name end -->

                                <!-- teacher info -->
                                    <?php
                                        $teacher_info_id = $row["teacher_id"];
                                       
                                        $query_teacher_info = "SELECT * FROM tutorregistration WHERE id='$teacher_info_id'";  
                                        $result_teacher_info = mysqli_query($conn, $query_teacher_info);
                                        while($row_teacher_info = mysqli_fetch_array($result_teacher_info))  
                                        {
                                                    $teacher_name =     $row_teacher_info["username"];
                                                
                                        }
            
                                ?>
                                <!-- teacher info end -->

                                <!-- teacher name -->
                                <td><?php echo $teacher_name; ?></td>
                                <!-- teacher name end -->

                             <!-- Tution Info -->
                               <?php
                                        $tution_info_id = $row["tution_info_id"];
                                       
                                        $query_tution_info = "SELECT * FROM tution_info WHERE id='$tution_info_id'";  
                                        $result_tution_info = mysqli_query($conn, $query_tution_info);
                                        while($row_tution_info = mysqli_fetch_array($result_tution_info))  
                                        {
                                                    $Tution_info_class =     $row_tution_info["TeacherClass"];
                                                    $Tution_info_subject =     $row_tution_info["TeacherSubject"];
                                                    $Tution_info_medium =     $row_tution_info["medium"];
                                                   // $Tution_info_salary =     $row_tution_info["Tutor_Salary"];
                                        }
            
                                ?>
                                <!-- Tution Info end -->   
                               
                            <!-- class -->
                               <td>
                                    <?php
                                           
                                          $query_Class = "SELECT class_name FROM class WHERE id='$Tution_info_class'";  
                                          $result_Class = mysqli_query($conn, $query_Class);
                                          while($row_Class = mysqli_fetch_array($result_Class))  
                                          {
                                                echo $row_Class["class_name"];
                                          }
                                    ?>
                                </td> 
                                <!-- class end -->
                               
                               <!-- subject -->
                               <td>
                                    <?php
                                          
                                          $query_sub = "SELECT subject_name FROM subject WHERE id='$Tution_info_subject'";  
                                          $result_sub = mysqli_query($conn, $query_sub);
                                          while($row_sub = mysqli_fetch_array($result_sub))  
                                          {
                                                echo $row_sub["subject_name"];
                                          }
                                    ?>
                                </td>
                                <!-- subject end  -->

                                <!-- medium -->
                                <td>
                                    <?php 
                                          $query_medium= "SELECT medium_name FROM medium WHERE id='$Tution_info_medium'";  
                                          $result_medium = mysqli_query($conn, $query_medium);
                                          while($row_medium = mysqli_fetch_array($result_medium))  
                                          {
                                                echo $row_medium["medium_name"];
                                          }
                                    ?>
                                </td> 
                                <!-- medium end -->

                                 <!-- tuition Days  -->
                                 <td><?php 
                                   
                                        $tution_days = explode(',', $student_tution_days);

                                        $query_tution_days = "SELECT id,day_name FROM days";
                                        $result_tution_days = mysqli_query($conn, $query_tution_days);

                                        while($row_tution_days = mysqli_fetch_array($result_tution_days))
                                        {
                                            $day_id = $row_tution_days["id"];
                                            
                                            foreach ($tution_days as $tution_day) {
                                                if($day_id == $tution_day){
                                                    echo $row_tution_days["day_name"];
                                                    echo ', ';
                                                   
                                                }
                                            }       
                                        }

                                           
                                    ?>
                                </td>  
                                <!-- tuition Days  end -->

                                 <!-- tuition time  -->
                                <td><?php 
                                        echo date("h:i a",strtotime($student_tution_time_from)); 
                                        echo ' To ';
                                        echo date("h:i a",strtotime($student_tution_time_to));
                                       
                                    ?>
                                </td>  
                                <!-- tuition time  end -->
                                
                                <!-- Start date -->
                                <td><?php
                                       $start_date = $row["started_date"];
                                       $date_pieces = explode( ' ', $start_date);
                                       echo  $date_pieces[0]; 
                                         // echo  $start_date->format("d-m-Y");
                                    ?>
                                </td>  
                                <!-- start date end -->

                                <!-- status -->
                                <td><?php 
                                    if ($row["status"] == 9) {
                                        echo '<input type="button" value="teaching " class="btn btn-xs btn-info "> '; 
                                    } 
                                ?></td>
                                <!-- status end -->
                               
                               <td>
                                 <input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /> 
                                  
                               </td>  

                               <td>
                                   <?php if( $row["approved_by"] == 1){
                                       echo "SUPERADMIN";
                                   } ?>
                               </td> 
                          </tr>  
                          <?php  
                          }  
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

    //delete data
      $(document).on('click', '.btn_action', function(){
           var action_value = $(this).val();
           var current_tr = $(this).closest('tr');
           
           if(action_value == "reject" ){
               var tution_id=$(this).data("id3");
           
              var action = "Reject";

           }else if(action_value == "accept"){

                var tution_id=$(this).data("id2");
            
                var action = "accept";
           }

           if(confirm("Are you sure you want to " + action +  " this tution?"))  
           {  
                $.ajax({  
                     url:"Tutor_tution_action.php",  
                     method:"POST",  
                     data:{tution_id:tution_id , action:action},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          current_tr.remove(); 
                     }  
                });  
           }  
      });
     //delete end  

 });  
 </script>

