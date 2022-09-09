<?php
    require('db_rw.php');
	session_start();

	if($_SESSION['abc'] == "validTutor"){
        $tutor_id = $_SESSION['Tutor_id'];
        
		// $myfile = fopen("Parent.txt", "r");
		// $data = fread($myfile, filesize("Parent.txt"));
		// fclose($myfile);
		// $arr = explode('|', $data);

		// echo "User Name: ". $arr[0]."<br/>";
		// echo "Password: ". $arr[1]."<br/>";
		
	}else{
		echo "login first";
		header("location: TutorLogin.php");
		
	}

    if(isset($_GET['status']))
    {
        $status = $_GET['status'];

        echo '<input type="hidden" name="status" value="'.$status.'" class="status" />';
    }

?>

<html>
<head>
      <title>Search a tuition</title>
	  
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

	    <script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">

        <script src="js/jquery-ui.js"></script>
		<link href = "css/jquery-ui.css" rel = "stylesheet">
		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">

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
    height: 1502px;
    background-color: grey;
}

.flex-item-1 {
    text-align: center;
    background-color: lightgrey;
    width: 1065px;
    height: 1500px;
    margin: 2px;
}

.flex-item-2 {
    text-align: center;
    background-color: lightgrey;
    width: 265px;
    height: 1500px;
	margin: 2px;
   
}

h1 {
   color: black;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
.h2{
    text-align:center;
    float:center;
    font-weight: bold;
	/* background-color: lightgrey;
	width: 1330px;
	height: 50px; */
}

#loading
{
 text-align:center; 
 background: url('loader.gif') no-repeat center; 
 height: 150px;
}

</style>

</head>
<body>

<div class="div1"><h1>DICCI NICCI TUTOR</h1></div>
<div class="div2">
<a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<h2 class="h2"> Search a Tution  </h2>

<!-- container -->
<div class="flex-container">
 
 <!-- flex 1 -->
  <div class="flex-item-1">
		<!-- col-md-12 -->
		<div class="col-md-12">

				
				  <br />
				    <!--  filter_data -->
					<div class="row filter_data">

					</div>
					<!-- filter_data end -->


            </div>
            <!-- col-md-12 end -->
  </div>
  <!-- flex 1 end -->
  

  <!-- flex 2 -->
  <div class="flex-item-2">

    <!-- col-md-3 -->
	<div class="col-md-12">                    
                   
                   <!-- salary -->
                    <div class="list-group">
                      <h3>Salary</h3>
                      <input type="hidden" id="hidden_minimum_salary" value="100" />
                      <input type="hidden" id="hidden_maximum_salary" value="10000" />
                      <p id="salary_show">100 - 10,000</p>
                      <div id="salary_range"></div>
                    </div> 
                    <!-- salary end --> 

                    <!-- medium -->
                  <div class="list-group">
                        <h3>Medium</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
                            <?php
                            //student medium

                                     $query = "SELECT medium FROM tution_info WHERE tutor_id='$tutor_id' AND status=1";  
                                     $result = mysqli_query($conn, $query);
                             //student medium end

                             $teacher_medium_id = array();

                             while($row = mysqli_fetch_array($result))  
                             { 
                    
                                        if(  !in_array($row['medium'], $teacher_medium_id) )
                                        {
                                            array_push($teacher_medium_id, $row['medium']);
                                        }  

                             }
                        
                            ?>

                            <?php 

                            // medium
                                $query_medium = "SELECT * FROM medium ";
                                $result_medium = mysqli_query($conn , $query_medium);
                            // medium end    
                             while($row_medium = mysqli_fetch_array($result_medium))  
                             { 
                                $medium_id = $row_medium["id"];

                                
                                foreach($teacher_medium_id as $tutor_medium_id){
                                    if($medium_id == $tutor_medium_id){
                                    
                                    ?>
                                        <div class="list-group-item checkbox">    
                                            <label><input type="checkbox" class="common_selector medium" value="<?php echo $row_medium["id"];  ?>"  > <?php echo $row_medium["medium_name"] ; ?></label>
                                        </div>
                                    <?php
                                    }
                                } 
                   
                             }

                              
                            ?>

                    </div>
                </div>
                <!-- medium end -->

                   <!-- subject -->
                   <div class="list-group">
                        <h3>Subject</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
                            <?php
                            //student subject

                                     $query = "SELECT TeacherSubject FROM tution_info WHERE tutor_id='$tutor_id' AND status=1";  
                                     $result = mysqli_query($conn, $query);
                             //student subject end

                             $tutor_subject_id = array();

                             while($row = mysqli_fetch_array($result))  
                             { 
                    
                                        if(  !in_array($row['TeacherSubject'], $tutor_subject_id) )
                                        {
                                            array_push($tutor_subject_id, $row['TeacherSubject']);
                                        }  

                             }
                        
                            ?>

                            <?php 

                            // subject
                                $query_subject = "SELECT * FROM subject ";
                                $result_subject = mysqli_query($conn , $query_subject);
                            // subject end    
                             while($row_subject = mysqli_fetch_array($result_subject))  
                             { 
                                $subject_id = $row_subject["id"];

                                
                                foreach($tutor_subject_id as $tut_subjecct_id){
                                    if($subject_id == $tut_subjecct_id){
                                    
                                    ?>
                                        <div class="list-group-item checkbox">    
                                            <label><input type="checkbox" class="common_selector subject" value="<?php echo $row_subject["id"];  ?>"  > <?php echo $row_subject["subject_name"] ; ?></label>
                                        </div>
                                    <?php
                                    }
                                } 
                   
                             }

                              
                            ?>

                    </div>
                </div>
                <!-- subject end -->

                  <!-- class -->
                  <div class="list-group">
                        <h3>Class</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
                            <?php
                            //student class

                                     $query = "SELECT TeacherClass FROM tution_info WHERE tutor_id='$tutor_id' AND status=1";  
                                     $result = mysqli_query($conn, $query);
                             //student class end

                             $tutor_class_id = array();

                             while($row = mysqli_fetch_array($result))  
                             { 
                    
                                        if(  !in_array($row['TeacherClass'], $tutor_class_id) )
                                        {
                                            array_push($tutor_class_id, $row['TeacherClass']);
                                        }  

                             }
                        
                            ?>

                            <?php 

                            // class
                                $query_class = "SELECT * FROM class ";
                                $result_class = mysqli_query($conn , $query_class);
                            // class end    
                             while($row_class = mysqli_fetch_array($result_class))  
                             { 
                                $class_id = $row_class["id"];

                                
                                foreach($tutor_class_id as $tut_class_id){
                                    if($class_id == $tut_class_id){
                                    
                                    ?>
                                        <div class="list-group-item checkbox">    
                                            <label><input type="checkbox" class="common_selector T_class" value="<?php echo $row_class["id"];  ?>"  > <?php echo $row_class["class_name"] ; ?></label>
                                        </div>
                                    <?php
                                    }
                                } 
                   
                             }

                              
                            ?>

                    </div>
                </div>
                <!-- class end -->

                  <!-- district -->
                  <div class="list-group">
                        <h3>District</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">
                            <?php

                            //student District

                             $query = "SELECT TutorDistrict FROM tutorregistration WHERE id='$tutor_id' AND status=1";  
                             $result = mysqli_query($conn, $query);
                           //student District end

                            $totur_district_id = array();

                            while($row = mysqli_fetch_array($result))  
                            { 
                                       if(  !in_array($row['TutorDistrict'], $totur_district_id) )
                                        {
                                            array_push($totur_district_id, $row['TutorDistrict']);
                                        } 
                                 
                            }        
                            ?>

                            <?php
                              $query_district = "SELECT * FROM district ";

                              $result_district = mysqli_query($conn , $query_district);

                            $district = '';

                            while($row_district = mysqli_fetch_array($result_district))  
                            {
                                foreach($totur_district_id as  $tut_district_id){
                                    if($tut_district_id == $row_district['id']){
                                        $district .= '<option value="'.$row_district["id"].'">'.$row_district["district_name"].'</option>';
                                    }
                                }   
                            }
                            ?>

                            <select name="TutorDistrict_filter" id="TutorDistrict_filter" class="form-control action ">
                                <option value="">Select one District</option>
                                <?php echo $district; ?>
                            </select>
                            <span id="TutorDistrict_filtermsg" class="text-danger "></span>
                            
                    </div>
                </div>
                <!-- district end -->

                    <!-- area -->
                    <div class="list-group">
                        <h3>Area</h3>
                    <div style=" overflow-y: auto; overflow-x: hidden;">  
                   
                            <select name="TutorArea_filter" id="TutorArea_filter" class="form-control area_action">
                                <option value="">Select one area</option>
                            </select>
                            <span id="TutorArea_filtermsg" class="text-danger "></span>
                            
                    </div>
                </div>
                <!-- area end -->

                
              
                
              
        

    </div>
    <!-- col-md-2 end -->
   
  </div>
  <!-- flex 2 end -->



</div>  
<!-- container end -->

</body>
</html>

<script>

var Tutor_district = null;
var Tutor_Area = null;

$(document).ready(function(){
    //status
    var status = $('.status').val();
    if(status != null){
        alert(status);
    }
    //status end

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_salary = $('#hidden_minimum_salary').val();
        var maximum_salary = $('#hidden_maximum_salary').val();

        var medium = get_filter('medium');
        var subject = get_filter('subject');
        var T_class = get_filter('T_class');
      //  console.log(subject);

        var TutorDistrict = Tutor_district;
        //console.log(StudentDistrict);

        var TutorArea = Tutor_Area;
        //console.log(StudentArea);


        $.ajax({
            url:"TuitionCheak.php",
            method:"POST",
            data:{
                  action:action, minimum_salary:minimum_salary, maximum_salary:maximum_salary, medium:medium, 
                  subject:subject, T_class:T_class, TutorDistrict:TutorDistrict, TutorArea:TutorArea
                 },
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    $('.common_selector').click(function(){
        filter_data(); 
    });

    // get checked value
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
   // get checked value end
   
    //district value
     $('.action').click(function(){ 
        Tutor_Area = null;
        Tutor_district =  $(this).val();
         filter_data();  
            
    });
    //district value end
    
    //area value
    $('.area_action').click(function(){ 
         Tutor_Area =  $(this).val();
         filter_data();  
            
    });
    //are value end
        
    
    // salary filter
    $('#salary_range').slider({
        range:true,
        min:100,
        max:10000,
        values:[100, 10000],
        step:100,
        stop:function(event, ui)
        {
            $('#salary_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_salary').val(ui.values[0]);
            $('#hidden_maximum_salary').val(ui.values[1]);
            filter_data();
        }
    });
    // salary filter end

    //dynamicly district,area select
  $('.action').change(function(){
  
    if($(this).val() != '')
    {
        var action = $(this).attr("id");
        var query = $(this).val();
     // alert(query);
        var result = '';
    if(action == "TutorDistrict_filter")
    {
        result = 'TutorArea_filter';
    }

    $.ajax({
        url:"Dynamic-district-area-select.php",
        method:"POST",
        data:{action:action, query:query},
                success:function(data){
                    //alert(data);
                $('#'+result).html(data);
                }
        })
    }
 
 });
 //dynamicly district,area select

});
</script>