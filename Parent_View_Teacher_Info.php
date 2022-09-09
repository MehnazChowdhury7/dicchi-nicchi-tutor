
<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validParent") || isset($_COOKIE['rm']) ){
     
        if(isset($_SESSION['tutor_id']))
		{
			$tutor_id = $_SESSION['tutor_id'];

            $tutor_class = $_SESSION['tutor_class']; 
            $tutor_subject = $_SESSION['tutor_subject']; 
            $tutor_medium = $_SESSION['tutor_medium'];
            $tutor_tution_days = $_SESSION['tutor_tution_days']; 
            $tutor_tution_time_from = $_SESSION['tutor_tution_time_from']; 
            $tutor_tution_time_to = $_SESSION['tutor_tution_time_to'];
            
		}else{
            $tutor_id = $_POST['tutor_id'];


            $tutor_class = $_POST['tutor_class']; 
            $tutor_subject = $_POST['tutor_subject']; 
            $tutor_medium = $_POST['tutor_medium'];
            $tutor_tution_days = $_POST['tutor_tution_days']; 
            $tutor_tution_time_from = $_POST['tutor_tution_time_from']; 
            $tutor_tution_time_to = $_POST['tutor_tution_time_to'];


            $_SESSION['tutor_class']  = $_POST['tutor_class']; 
            $_SESSION['tutor_subject'] = $_POST['tutor_subject']; 
            $_SESSION['tutor_medium'] = $_POST['tutor_medium'];
            $_SESSION['tutor_tution_days']  = $_POST['tutor_tution_days']; 
            $_SESSION['tutor_tution_time_from'] = $_POST['tutor_tution_time_from']; 
            $_SESSION['tutor_tution_time_to'] = $_POST['tutor_tution_time_to'];  

        
        }

        
	
        // tutor info 
        $sql_tutor = "SELECT * FROM tutorregistration WHERE  id='$tutor_id' ";

        $result_tutor = mysqli_query($conn , $sql_tutor);
        
        if($result_tutor->num_rows != null){
            $row_tutor = mysqli_fetch_array($result_tutor);
                
                $tutor_id = $row_tutor['id'];	
                $tutor_name = $row_tutor['username'];
                //$password = md5($row['password']);
                $tutor_email = $row_tutor['email'];
                $tutor_mobile = $row_tutor['mobile'];
                $tutor_image  = $row_tutor['image'];
                $tutor_gender = $row_tutor['tutorgender'];
                $tutor_District = $row_tutor['TutorDistrict'];
                $tutor_Area  = $row_tutor['TutorArea'];
            
        }else{
            //echo "data not edit".mysqli_error($conn);
            header('location: ParentLogin.php?status=tutor-not-found');
        }
        // tutor info end

          // tutor tution info 
          $sql_tutor_tution = "SELECT * FROM tution_info WHERE  tutor_id='$tutor_id' AND medium='$tutor_medium' AND TeacherClass='$tutor_class'  AND TeacherSubject='$tutor_subject' 
                               AND tutor_tution_days='$tutor_tution_days' AND tutor_tution_time_from='$tutor_tution_time_from' AND tutor_tution_time_to='$tutor_tution_time_to' ";

          $result_tutor_tution = mysqli_query($conn , $sql_tutor_tution);
          
          if($result_tutor_tution->num_rows != null){
              $row_tutor_tution = mysqli_fetch_array($result_tutor_tution);
                  
                  $tutor_tution_info_id = $row_tutor_tution['id'];
                  $tutor_tution_medium = $row_tutor_tution['medium'];	
                  $tutor_tution_class = $row_tutor_tution['TeacherClass'];
                  $tutor_tution_subject = $row_tutor_tution['TeacherSubject'];
                  $tutor_tution_salary = $row_tutor_tution['Tutor_Salary'];

                  $tutor_tution_days  = $row_tutor_tution['tutor_tution_days'];
                  $tutor_tution_time_from  = $row_tutor_tution['tutor_tution_time_from'];
                  $tutor_tution_time_to  = $row_tutor_tution['tutor_tution_time_to'];

                  if(isset($_SESSION['tutor_id'])){
                    unset($_SESSION['tutor_id']);         
                  }
 
          }else{
              
              header('location: Search%20a%20tutor.php?status=tution-info-not-found');
          }
          // tutor tution info end
        
            
    }else {
        header('location: ParentLogin.php?status=invalid-creadiantial');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];

			echo $status;
		}

?>



<html>
<head>
        <title>Parent home</title>

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
    height: 380px;    
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
    margin: 245px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div6 {
    text-align: center;
    width: 310px;
    height: 90px;    
    padding: 5px;
    margin: -340px 320px;
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
    margin: 0px -20px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div10 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: -312px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div11 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: 310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div12 {
    text-align: center;
    width: 320px;
    height: 90px;    
    padding: 5px;
    margin: -310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div13 {
    text-align: center;
    width: 20px;
    height: 50px;    
    padding: 5px;
    margin: 493px 600px;
  
	}
.div14 {
    text-align: center;
    width: 500px;
    height: 50px;    
    padding: 5px;
    margin: 50px 50px;
	}
.div15 {
    text-align: center;
    width: 320px;
    height: 70px;    
    padding: 5px;
    margin: 310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div16 {
    text-align: center;
    width: 312px;
    height: 110px;    
    padding: 5px;
    margin: -420px -20px;
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
    height: 610px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 560px;
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
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Search%20a%20tutor.php" class="button">Search tutor</button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php" class="button">Parent Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
<a href='Parentlogout.php' class="button"> logout </button></a> <br/><br/>;

</div>


<div class="flex-container">
   

<div class="flex-item">
  <h1> Tutor All Info   </h1> 
   
  <div class="container">
               <!-- div 3 -->
               <div class="div3">
                    <img src="upload/tutor/<?php echo $tutor_image ?>"  height="300px" width="300px"  />
               </div>
               <!-- div 3 end -->
               
                <!-- div 4   -->
               <div class="div4">
                     
                      <table class="table table-bordered">  
                          <tr>  
                              <th width="40%"> Tution  info ID:</th>
                              <th width="20%"><?php echo $tutor_tution_info_id ?></th>
                              
                         </tr>
                         <tr>  
                              <th width="40%"> Tutor ID :</th>
                              <th width="20%"><?php echo $tutor_id ?></th>
                              
                         </tr>  
                         <tr>  
                              <th width="40%">Name :</th>
                              <th width="20%"><?php echo $tutor_name ?></th>   
                         </tr>

                         <tr>  
                              <th width="40%">Gender :</th>
                              
                              <!-- gender -->
                              <?php 
                                 
                                 $query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
                                 $result_gender = mysqli_query($conn, $query_gender);
                                 while($row_gender = mysqli_fetch_array($result_gender))
                                 {
                                  $gender_id = $row_gender["id"];
                                  if($gender_id == $tutor_gender){
                                       $gender_name = $row_gender["gender_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- gender end -->
                              <th width="20%"><?php echo $gender_name ?></th>  
                         </tr>

                         <tr>
                              <th width="40%">Tution Days :</th>
                           <!-- tutor tution days -->
                           <?php $tution_days = explode(',', $tutor_tution_days);

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
                                <!-- tutor tution days end -->
                         </tr>
                         
                         <!-- tutor Tution Time  -->
                         <tr>  
                              <th width="40%">Time :</th>
                              <th width="20%"><?php echo date("h:i a",strtotime($tutor_tution_time_from)); ?> to <?php echo date("h:i a",strtotime($tutor_tution_time_to)); ?></th>   
                         </tr>
                         <!-- tutor Tution Time end -->
                        
                         
                    </table>  

               </div>
                <!-- div 4 end   -->

               <!-- div 5   -->
               <div class="div5">
                     
                     <table class="table table-bordered">  
                        <tr>  
                             <th width="10%">Class :</th>
                             <th width="20%"><?php echo $tutor_tution_class ?></th>
                             
                        </tr>

                        <tr>  
                             <th width="10%">Subject :</th>

                               <!-- subject -->
                               <?php 
                                 
                                 $query_subject = "SELECT id,subject_name FROM subject ORDER BY id ASC";
                                 $result_subject = mysqli_query($conn, $query_subject);
                                 while($row_subject = mysqli_fetch_array($result_subject))
                                 {
                                  $subject_id = $row_subject["id"];
                                  if($subject_id == $tutor_tution_subject){
                                       $subject_name = $row_subject["subject_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- subject end -->
                             <th width="20%"><?php echo $subject_name ?></th>
                             
                        </tr>
                        
                        <tr>  
                             <th width="10%"> Medium :</th>

                               <!-- medium -->
                               <?php 
                                 
                                 $query_medium = "SELECT id,medium_name FROM medium ORDER BY id ASC";
                                 $result_medium = mysqli_query($conn, $query_medium);
                                 while($row_medium = mysqli_fetch_array($result_medium))
                                 {
                                  $medium_id = $row_medium["id"];
                                  if($medium_id == $tutor_tution_medium){
                                       $medium_name = $row_medium["medium_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- medium end -->

                             <th width="20%"><?php echo $medium_name ?></th>
                             
                        </tr>  
                        
                        
                        <tr>  
                             <th width="10%">Salary :</th>
                             <th width="20%"><?php echo $tutor_tution_salary ?></th>
                             
                        </tr>
                       
                        
                   </table>  

              </div>
     
               <!-- div 5 end   -->

               <!-- div 6   -->
               <div class="div6">
                     
                     <table class="table table-bordered">  
                        <tr>  
                             <th width="10%">District :</th>

                               <!-- district -->
                               <?php 
                                 
                                 $query_district = "SELECT id,district_name FROM district ORDER BY id ASC";
                                 $result_district = mysqli_query($conn, $query_district);
                                 while($row_district = mysqli_fetch_array($result_district))
                                 {
                                  $district_id = $row_district["id"];
                                  if($district_id == $tutor_District){
                                       $district_name = $row_district["district_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- district end -->

                             <th width="20%"><?php echo $district_name ?></th>
                             
                        </tr>

                        <tr>  
                             <th width="10%">Area :</th>

                              <!-- area -->
                              <?php 
                                 
                                 $query_area = "SELECT id,area_name FROM area ORDER BY id ASC";
                                 $result_area = mysqli_query($conn, $query_area);
                                 while($row_area = mysqli_fetch_array($result_area))
                                 {
                                  $area_id = $row_area["id"];
                                  if($area_id == $tutor_Area){
                                       $area_name = $row_area["area_name"];
                                    
                                  }   
                                  
                                 }
                              ?>
                              <!-- area end -->

                             <th width="20%"><?php echo $area_name ?></th>
                             
                        </tr>   
                        
                   </table>  

              </div>
     
               
               <!-- div 6 end   -->
   

   </div>
           
           
</div>

<div class="flex-item">
 
 <div class="container" >
      
    
    <div class="row">
      
      <?php 
        if(isset($_GET['status'])){
             $status = $_GET['status'];
                if($status =="Tution-Request-Completed"){
                  echo  '<div class="div14">
                             <h1> Tution Request Completed  </h1>
                         </div>';
                }elseif ($status =="Already-Requested") {
                    echo  '<div class="div14">
                             <h1> Already Requested  </h1>
                        </div>';
                }
        }else{
            //  div 7
           echo '<div class="div7">
                <h1>Tutor Request For :  </h1>
            </div>';
        
        //    div 7 end 

        // div 8 
       echo '<div class="col-md-3 div8">
             
             <select name="student_list" id="student_list" class="form-control">
                 <option value="none">Select One Student</option>';
                      
                         //student info
                             $parent_id = $_SESSION['id'];
                         
                             $student_info_query = "SELECT * FROM student_info WHERE  parent_id='$parent_id' AND status=1 ";
                             $student_info_result = mysqli_query($conn, $student_info_query);
                         //student info end
                     $Student_matching = 0;
 
                     while($student_info_row = mysqli_fetch_array($student_info_result))
                     {
                         $student_class = $student_info_row["studentclass"];
                         $student_medium = $student_info_row["medium"];
                         $student_subject = $student_info_row["subject"];
                         $student_district = $student_info_row["studentDistrict"];
                         $student_area = $student_info_row["studentArea"];
                         $student_Offer_Salary = $student_info_row["Offer_Salary"];

                         $student_tution_days = $student_info_row["tution_days"];
                         $student_tution_time_from = $student_info_row["tution_time_from"];
                         $student_tution_time_to = $student_info_row["tution_time_to"];
                         
 
                         if($student_class == $tutor_tution_class && $student_medium == $tutor_tution_medium && $student_subject == $tutor_tution_subject && 
                             $student_district == $tutor_District && $student_area == $tutor_Area && $student_Offer_Salary == $tutor_tution_salary && 
                             $student_tution_days == $tutor_tution_days && $student_tution_time_from == $tutor_tution_time_from && $student_tution_time_to == $tutor_tution_time_to){
                             echo '<option value="'.$student_info_row["id"].'">'.$student_info_row["studentname"].'</option>';
 
                             $Student_matching++; 
                         }
                         
                     }
 
                     if($Student_matching == 0){
                         echo '<option value="none"> No Student matching for This Teacher</option>';
                     }
 
                     
          echo   '</select>
     </div>';
     
    
         // div 8 end 
        } 
        
       ?>
      
       

     


    </div>
    <br />

    <div class="col-md-8" id="student_details" style="display:none">
         
          <!-- student image -->
             <!-- div 9 -->
             <div class="div9">
                    <img src="<?php echo $Student_image ?>" width="300px" height="300px"  id="Student_image" />
               </div>
             <!-- div 9 end -->
          <!-- student image end -->

<!-- div 10 --> 
       <div class="div10">        
            <table class="table table-bordered">
               
                <tr>
                    <th width="40%" align="right"><b>Student Id :</b></th>
                    <th width="50%"><span id="Student_id"></span></th>
                </tr>

                <tr>
                    <th width="20%" align="right"><b>Name :</b></th>
                    <th width="50%"><span id="Student_name"></span></th>
                </tr>
                <!-- gender -->
                <tr>
                    <th width="20%" align="right"><b>Gender :</b></th>
                    <th width="50%"><span id="Student_gender"></span></th>
                </tr>
                <!-- gender end -->
                
            </table>
        </div>
<!-- div 10 end            -->

<!-- div 11 --> 
       <div class="div11">        
            <table class="table table-bordered">
               
                <tr>
                    <th width="20%" align="right"><b>Class :</b></th>
                    <th width="50%"><span id="Student_class"></span></th>
                </tr>

                <tr>
                    <th width="20%" align="right"><b>Subject :</b></th>
                    <th width="50%"><span id="Student_subject"></span></th>
                </tr>

                <tr>
                    <th width="20%" align="right"><b>Medium :</b></th>
                    <th width="50%"><span id="Student_medium"></span></th>
                </tr>
                
            </table>
        </div>  
<!-- div 11 end            -->


<!-- div 12 --> 
        <div class="div12">        
            <table class="table table-bordered">
               
                <tr>
                    <th width="20%" align="right"><b>District :</b></th>
                    <th width="50%"><span id="Student_district"></span></th>
                </tr>

                <tr>
                    <th width="20%" align="right"><b>Area :</b></th>
                    <th width="50%"><span id="Student_area"></span></th>
                </tr>

            </table>
        </div> 
<!-- div 12 end            -->

<!-- div 15 --> 
<div class="div15">        
            <table class="table table-bordered">
               
                <tr>
                    <th width="20%" align="right"><b>Offer Salary :</b></th>
                    <th width="50%"><span id="Student_offer_salary"></span></th>
                </tr> 

            </table>
        </div> 
<!-- div 15 end            -->

<div class="div16">        
            <table class="table table-bordered">
               
                <tr>
                    <th width="30%" align="right"><b>Tution Days :</b></th>
                    <th width="50%"><span id="student_tution_days"></span> </th>
                </tr>
                <tr>
                    <th width="20%" align="right"><b>Time :</b></th>
                    <th width="50%"><span id="student_tution_time_from"></span> To <span id="student_tution_time_to"></span></th>
                </tr> 

            </table>
        </div>

<!-- div 16 -->
 

<!-- div 16 end -->
   
    <!-- dive 13 -->
        <div class="div13">
           <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Parent_Request_Tutor_For_Tution_Info_check.php" >
                
                <input type="hidden" name="parent_id"  value="<?php echo $parent_id ?>" />
                <input type="hidden" name="student_id"  value="" id="StudentId" />
                <input type="hidden" name="tutor_id"  value="<?php echo $tutor_id ?>" />
                <input type="hidden" name="tution_info_id"  value="<?php echo $tutor_tution_info_id ?>" />

                <button type="submit" name="submit" id="submit" class="btn btn-info">Request</button>
            </forrm>    
        </div>
     <!-- div 13 end -->

    </div>
    
    </div>

</div>

</div>

</body>
</html>

<script>
$(document).ready(function(){

 
    
 $('#student_list').click(function(){

    var student_id = $('#student_list').val();
    console.log(student_id);
    if(student_id != 'none')
    {
        $.ajax({
            url:"student_info_for_teacher_match.php",
            method:"POST",
            data:{student_id:student_id},
            dataType:"JSON",
            success:function(data)
            {
                $('#student_details').css("display", "block");

                $('#Student_image').attr('src', data.Student_image);
               
                $('#Student_id').text(data.Student_id);
                $('#StudentId').val(data.Student_id);
                $('#Student_name').text(data.Student_name);
                $('#Student_gender').text(data.Student_gender);
               
                $('#Student_class').text(data.Student_class);
                $('#Student_subject').text(data.Student_subject);
                $('#Student_medium').text(data.Student_medium);
               
                $('#Student_district').text(data.Student_district);
                $('#Student_area').text(data.Student_area);

                $('#Student_offer_salary').text(data.Student_offer_salary);
                
                $('#student_tution_days').text(data.student_tution_days);
                $('#student_tution_time_from').text(data.student_tution_time_from);
                $('#student_tution_time_to').text(data.student_tution_time_to);
               
            }
        })
    }
    else
    {
        //alert("Please Select Employee");
        $('#student_details').css("display", "none");
    }
 });

});
</script>
