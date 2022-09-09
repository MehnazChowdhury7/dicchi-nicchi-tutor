<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validTutor") || isset($_COOKIE['rm']) ){
     
            if(isset($_SESSION['parent_id']) && isset($_SESSION['student_id'])){
                $parent_id = $_SESSION['parent_id'];
                $student_id = $_SESSION['student_id'];    
             
            }else{
                $parent_id = $_POST['parent_id'];
                $student_id = $_POST['student_id'];
            } 

            $tutor_id = $_SESSION['Tutor_id'];
            

	
        // parent info 
        $sql_parent = "SELECT * FROM parentregistration WHERE  id='$parent_id' ";
        $result_parent = mysqli_query($conn , $sql_parent);
        
        if($result_parent->num_rows != null){
            $row_parent = mysqli_fetch_array($result_parent);
                
                $parent_id = $row_parent['id'];	
                $parent_name = $row_parent['username'];
                $parent_image = $row_parent['image'];
                
            
        }else{
            //echo "data not edit".mysqli_error($conn);
            header('location: Search a tution.php?status=parent-not-found');
        }
        // parent info end

          // student info 
          $sql_student_info = "SELECT * FROM student_info WHERE  id='$student_id'  ";
          $result_student_info = mysqli_query($conn , $sql_student_info);
          
          if($result_student_info->num_rows != null){
              $row_student_info = mysqli_fetch_array($result_student_info);
                  
                  $student_info_id = $row_student_info['id'];
                  $student_info_student_id = $row_student_info['student_id'];
                  $student_info_name = $row_student_info['studentname'];
                  $student_info_image = $row_student_info['studentimage'];
                  $student_info_class = $row_student_info['studentclass'];
                  $student_info_medium = $row_student_info['medium'];
                  $student_info_subject = $row_student_info['subject'];
                  $student_info_gender = $row_student_info['studentgender'];
                  $student_info_District = $row_student_info['studentDistrict'];
                  $student_info_Area = $row_student_info['studentArea'];
                  $student_info_Offer_Salary = $row_student_info['Offer_Salary'];

                  $student_tution_days = $row_student_info['tution_days'];
                  $student_tution_time_from = $row_student_info['tution_time_from'];
                  $student_tution_time_to = $row_student_info['tution_time_to'];

                //tutor tuition info
                $sql_tuition_info = "SELECT * FROM tution_info WHERE  tutor_id='$tutor_id'";
                $result_tuition_info = mysqli_query($conn , $sql_tuition_info);  

                if($result_tuition_info->num_rows != null){
                    while($row_tuition_info = mysqli_fetch_array($result_tuition_info))  
                    {  
                        $tuition_info_class = $row_tuition_info['TeacherClass'];
                        $tuition_info_medium = $row_tuition_info['medium'];
                        $tuition_info_subject = $row_tuition_info['TeacherSubject'];
                        $tuition_info_Tutor_Salary = $row_tuition_info['Tutor_Salary'];

                        $tutor_tution_days = $row_tuition_info['tutor_tution_days'];
                        $tutor_tution_time_from = $row_tuition_info['tutor_tution_time_from'];
                        $tutor_tution_time_to = $row_tuition_info['tutor_tution_time_to'];

                        if($tuition_info_class == $student_info_class && $tuition_info_medium == $student_info_medium && $tuition_info_subject == $tuition_info_subject && $tuition_info_Tutor_Salary == $student_info_Offer_Salary && 
                            $tutor_tution_days == $student_tution_days && $tutor_tution_time_from == $student_tution_time_from && $tutor_tution_time_to == $student_tution_time_to  ){
                                
                            $tuition_match = 1;
                            $tuition_info_id = $row_tuition_info['id']; 

                            if(isset($_SESSION['parent_id']) && isset($_SESSION['student_id'])){
                                    unset($_SESSION['parent_id']);
                                    unset($_SESSION['student_id']); 
                            }
                        }
                    }

                }
                //tutor tuition info end
               
              
          }else{
              //echo "data not edit".mysqli_error($conn);
              header('location: Search%20a%20tution.php?status=student-info-not-found');
          }
          // student info end

          if($tuition_match != 1){
            header('location: Search%20a%20tution.php?status=tution-not-match');

          }

        
            
    }else {
        header('location: TutorLogin.php?status=invalid-creadiantial');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];

           echo '<input type="hidden" name="status" value="'.$status.'" class="status" />';
		}

?>



<html>
<head>
        <title>Tutor Home</title>

        <script src="js/jquery-1.10.2.min.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">

		
	
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
    width: 310px;
    height: 310px;    
    padding: 5px;
    margin: 4px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div4 {
    text-align: center;
    width: 310px;
    height: 248px;    
    padding: 5px;
    margin: -314px 320px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div5 {
    text-align: center;
    width: 310px;
    height: 170px;    
    padding: 5px;
    margin: 310px 320px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div6 {
    text-align: center;
    width: 310px;
    height: 90px;    
    padding: 5px;
    margin: -400px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div7 {
    text-align: center;
    width: 330px;
    height: 70px;    
    padding: 5px;
    margin: -10px 10px;
  
	} 
.div8 {
    text-align: center;
    width: 210px;
    height: 50px;    
    padding: 5px;
    margin: -40px 348px;
   
	}
.div9 {
    text-align: center;
    width: 312px;
    height: 312px;    
    padding: 5px;
    margin: 0px 20px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div10 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: -312px 340px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div11 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: 310px 340px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div12 {
    text-align: center;
    width: 320px;
    height: 90px;    
    padding: 5px;
    margin: -310px 340px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div13 {
    text-align: center;
    width: 20px;
    height: 50px;    
    padding: 5px;
    margin: -295px 610px;
  
	}
.div14 {
    text-align: center;
    width: 310px;
    height: 135px;    
    padding: 5px;
    margin: 280px 20px;
    border: 1px solid red;
    box-sizing: border-box;
  
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
    height: 580px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 525px;
    margin: 2px;
}

h1 {
   color: black;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

</style>

</head>
<body>

<div class="div1"><h1>DICCI NICCI TUTOR</h1></div>
<div class="div2">

<a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Search%20a%20tution.php" class="button">Search Tuition</button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorthome.php" class="button">Tutor Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
<a href='Parentlogout.php' class="button"> logout </button></a> <br/><br/>;

</div>


<div class="flex-container">
   

<div class="flex-item">
  <h1> Parent All Info   </h1> 
   
  <div class="container">
               <!-- div 3 -->
               <div class="div3">
                    <img src="upload/parent/<?php echo $parent_image ?>"  height="300px" width="300px"  />
               </div>
               <!-- div 3 end -->
               
                <!-- div 4   -->
               <div class="div4">
                     
                      <table class="table table-bordered">  
                          <tr>  
                              <th width="40%"> Parent ID:</th>
                              <th width="20%"><?php echo $parent_id ?></th>
                              
                         </tr>
                         <tr>  
                              <th width="40%"> Parent Name :</th>
                              <th width="20%"><?php echo $parent_name ?></th>
                              
                         </tr>     
                         <tr>  
                              <th width="40%"> Offer Salary :</th>
                              <th width="20%"><?php echo $student_info_Offer_Salary ?></th>
                              
                         </tr>     
                         
                    </table>  

               </div>
                <!-- div 4 end   -->
   

   </div>
           
           
</div>

<div class="flex-item">
  <h1> Student All Info   </h1> 
 <div class="container" >
      
    
    <div class="row">
               <!-- div 9 -->
                <div class="div9">
                    <img src="upload/student/<?php echo $student_info_image ?>"  height="300px" width="300px"  />
               </div>
               <!-- div 9 end -->
               
                <!-- div 10   -->
               <div class="div10">
                     
                      <table class="table table-bordered">  
                          <tr>  
                              <th width="40%"> Student ID:</th>
                              <th width="20%"><?php echo $student_info_student_id ?></th>
                              
                         </tr>
                         <tr>  
                              <th width="40%"> Student Name :</th>
                              <th width="20%"><?php echo $student_info_name ?></th>
                              
                         </tr>  
                         <tr>  
                              <th width="40%"> Student Gender :</th>
                               <!-- gender -->
                               <?php 
                                 
                                 $query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
                                 $result_gender = mysqli_query($conn, $query_gender);
                                 while($row_gender = mysqli_fetch_array($result_gender))
                                 {
                                  $gender_id = $row_gender["id"];
                                  if($gender_id == $student_info_gender){
                                       $gender_name = $row_gender["gender_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- gender end -->
                              <th width="20%"><?php echo $gender_name ?></th>
                              
                         </tr>        
                         
                    </table>  

               </div>
                <!-- div 10 end   -->

                 
                <!-- div 11   -->
               <div class="div11">
                     
                     <table class="table table-bordered">  
                         <tr>  
                             <th width="40%"> Student Class:</th>
                             <th width="20%"><?php echo $student_info_class ?></th>
                             
                        </tr>
                        <tr>  
                             <th width="40%"> Student Subject :</th>
                              <!-- subject -->
                              <?php 
                                 
                                 $query_subject = "SELECT id,subject_name FROM subject ORDER BY id ASC";
                                 $result_subject = mysqli_query($conn, $query_subject);
                                 while($row_subject = mysqli_fetch_array($result_subject))
                                 {
                                  $subject_id = $row_subject["id"];
                                  if($subject_id == $student_info_subject){
                                       $subject_name = $row_subject["subject_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- subject end -->
                             <th width="20%"><?php echo $subject_name ?></th>
                             
                        </tr>  
                        <tr>  
                             <th width="40%"> Student Medium :</th>
                             <!-- medium -->
                             <?php 
                                 
                                 $query_medium = "SELECT id,medium_name FROM medium ORDER BY id ASC";
                                 $result_medium = mysqli_query($conn, $query_medium);
                                 while($row_medium = mysqli_fetch_array($result_medium))
                                 {
                                  $medium_id = $row_medium["id"];
                                  if($medium_id == $student_info_medium){
                                       $medium_name = $row_medium["medium_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- medium end -->
                             <th width="20%"><?php echo $medium_name ?></th>
                             
                        </tr>       
                        
                   </table>  

              </div>
               <!-- div 11 end   -->

                
                <!-- div 12   -->
                <div class="div12">
                     
                     <table class="table table-bordered">  
                         <tr>  
                             <th width="40%"> Student District:</th>
                             <!-- district -->
                             <?php 
                                 
                                 $query_district = "SELECT id,district_name FROM district ORDER BY id ASC";
                                 $result_district = mysqli_query($conn, $query_district);
                                 while($row_district = mysqli_fetch_array($result_district))
                                 {
                                  $district_id = $row_district["id"];
                                  if($district_id == $student_info_District){
                                       $district_name = $row_district["district_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- district end -->
                             <th width="20%"><?php echo $district_name ?></th>
                             
                        </tr>
                        <tr>  
                             <th width="40%"> Student Area :</th>
                             <!-- area -->
                             <?php 
                                 
                                 $query_area = "SELECT id,area_name FROM area ORDER BY id ASC";
                                 $result_area = mysqli_query($conn, $query_area);
                                 while($row_area = mysqli_fetch_array($result_area))
                                 {
                                  $area_id = $row_area["id"];
                                  if($area_id == $student_info_Area){
                                       $area_name = $row_area["area_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- area end -->
                             <th width="20%"><?php echo $area_name ?></th>
                             
                        </tr>        
                        
                   </table>  

              </div>
               <!-- div 12 end   -->

               <!-- div 14   -->
               <div class="div14">
                     
                     <table class="table table-bordered">  
                          
                          <tr>
                              <th width="40%">Tution Days :</th>
                           <!-- student tution days -->
                           <?php $tution_days = explode(',', $student_tution_days);

                                $query_tution_days = "SELECT id,day_name FROM days";
                                $result_tution_days = mysqli_query($conn, $query_tution_days);
                                
                                echo '<th width="20%">';
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
                                echo '</th>'; 
                                ?>
                                <!-- student tution days end -->
                         </tr>
                        
                         <!-- tutor Tution Time  -->
                         <tr>  
                              <th width="40%">Time :</th>
                              <th width="20%"><?php echo date("h:i a",strtotime($student_tution_time_from)); ?> to <?php echo date("h:i a",strtotime($student_tution_time_to)); ?></th>   
                         </tr>
                         <!-- tutor Tution Time end -->       
                        
                   </table>  

              </div>
               <!-- div 14 end   -->
      

    </div>
    <br />

   
        <div class="div13">
           <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Request_Parent_For_Tution_Info_check.php" >
                
                <input type="hidden" name="parent_id"  value="<?php echo $parent_id ?>" />
                <input type="hidden" name="student_info_id"  value="<?php echo $student_info_id ?>" />
                <input type="hidden" name="tutor_id"  value="<?php echo $tutor_id ?>" />
                <input type="hidden" name="tuition_info_id"  value="<?php echo $tuition_info_id ?>" />

                <button type="submit" name="submit" id="submit" class="btn btn-info">Request</button>
            </forrm>    
        </div>

  </div>
    </div>

</div>



</body>
</html>

<script>
$(document).ready(function(){
    var status = $('.status').val();
    if(status != null){
        alert(status);
    }

 


});
</script>
