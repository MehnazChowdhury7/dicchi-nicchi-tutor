<?php
	require('db_rw.php');
    session_start();
    

	if( ($_SESSION['abc'] == "validParent") || isset($_COOKIE['rm']) ){
     
        //$id = $_SESSION['id'];

        if(isset($_GET['std_info_id'])){

            $student_info_id = $_GET['std_info_id'];
           // die($student_info_id);
            
            $sql = "SELECT * FROM student_info WHERE  id='$student_info_id' ";
            
            $result = mysqli_query($conn , $sql);

            if($result->num_rows != null){
                $row = mysqli_fetch_array($result);
                    
                    $student_id = $row['student_id'];	
                    $studentname = $row['studentname'];
                    $studentimage  = $row['studentimage'];
                    $studentgender  = $row['studentgender'];
                    $medium  = $row['medium'];
                    $studentclass  = $row['studentclass'];
                    $studentDistrict  = $row['studentDistrict'];
                    $subject  = $row['subject'];
                    $Offer_Salary  = $row['Offer_Salary'];
                    $tution_time_from  = $row['tution_time_from'];
                    $tution_time_to  = $row['tution_time_to'];
                    $tution_days  = $row['tution_days'];  
                
            }else{
                header('location: Parent_student_update.php?status=student_not_found');
            }
        }else {
            header('location: Parent_student_update.php?status=student_not_found');
        } 

        //studentclass
        $class_name = '';
        $query_class = "SELECT id,class_name FROM class ORDER BY id ASC";
        $result_class = mysqli_query($conn, $query_class);
        while($row_class = mysqli_fetch_array($result_class))
        {
         $class_id = $row_class["id"];
         if($class_id == $studentclass){
           $class_name .= '<option value="'.$row_class["id"].'" selected="selected" >'.$row_class["class_name"].'</option>';
         }  
         
        }
        //studentclass end

        
        //subject
        $subject_name = '';
        $query_subject = "SELECT id,subject_name FROM subject ORDER BY id ASC";
        $result_subject = mysqli_query($conn, $query_subject);
        while($row_subject = mysqli_fetch_array($result_subject))
        {
         $subject_id = $row_subject["id"];
         if($subject_id == $subject){
           $subject_name .= '<option value="'.$row_subject["id"].'" selected="selected" >'.$row_subject["subject_name"].'</option>';
         }else{
           $subject_name .= '<option value="'.$row_subject["id"].'" >'.$row_subject["subject_name"].'</option>';
         }   
         
        }
        //subject end

         //studentgender
         $gender_name = '';
         $query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
         $result_gender = mysqli_query($conn, $query_gender);
         while($row_gender = mysqli_fetch_array($result_gender))
         {
          $gender_id = $row_gender["id"];
          if($gender_id == $studentgender){
            $gender_name .= '<option value="'.$row_gender["id"].'" selected="selected" >'.$row_gender["gender_name"].'</option>';
          }   
          
         }
         //studentgender end

         //medium
         $medium_name = '';
         $query_medium = "SELECT id,medium_name FROM medium ORDER BY id ASC";
         $result_medium = mysqli_query($conn, $query_medium);
         while($row_medium = mysqli_fetch_array($result_medium))
         {
          $medium_id = $row_medium["id"];
          if($medium_id == $medium){
            $medium_name .= '<option value="'.$row_medium["id"].'" selected="selected" >'.$row_medium["medium_name"].'</option>';
          }   
          
         }
         //medium end

	   //district
        $district = '';
        $query = "SELECT id,district_name FROM district ORDER BY id ASC";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $district_id = $row["id"];
            if($district_id == $studentDistrict){
                $district .= '<option value="'.$row["id"].'" selected="selected" >'.$row["district_name"].'</option>';
              }
         
        }
        //district end

        // student tution days
        $tution_days = explode(',', $tution_days);
        $tution_days_selected = array();

        $student_tution_days_selected = '';
        $query = "SELECT id,day_name FROM days ORDER BY id ASC";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($result))
        {
            $day_id = $row["id"];
            $student_tution_days_selected .= ' <option value=" ';
            $student_tution_days_selected .= $row["id"]. ' " ';
            foreach ($tution_days as $tution_day) {
                if($day_id == $tution_day){
                    $student_tution_days_selected .= ' selected="selected" ';
                }
            }
            $student_tution_days_selected .= '>'  .$row["day_name"].'</option>';
        }
        

        // student tution days end
			 
    }else {
        header('location: ParentLogin.php?status=login-first');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];

			if($status == "invaliduser"){
				echo "Invalid username/password";
			}else if($status == "nullvalue"){
				echo "username/password can't be empty";
			}else if($status == "invalid-creadiantial"){
				echo "invalid-creadiantial";
			}else if($status == "file-not-found"){
				echo "file-not-found";
			}
            else if($status == "fild-empty"){
				echo "fild-empty";
			}else if($status == "student-add-completed"){
				echo "student-add-completed";
			}else if($status == "is-not-a-valid-file"){
				echo "is-not-a-valid-file";
			}else if($status == "somethig-worng"){
				echo "somethig-worng";
			}
            else if($status == "student-update-successfully"){
				echo "student-update-successfully";
			}
		}

mysqli_close($conn);
?>

<html>
<head>
      <title>student tution info update</title>
    
      <!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<!-- <script src="js/jquery-1.10.2.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="css/maxcdn-bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	
	<!-- Popper JS -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->
	<script src="js/popper.js"></script>

    <!-- multiselete -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
	<!-- multiselete end-->

    <!-- time -->
        <!-- <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metismenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.min.js"></script> -->
    <!-- time end -->

	  
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
    margin: -41px 620px;
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
    height: 490px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 440px;
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

<h2 class="h2">Student tution Info Update</h2>

<div class="flex-container">
  
  <div class="flex-item">
      <div  class="col-lg-8 m-auto d-block">
        <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Parent_students_Tution_update_check.php" onsubmit="return validation()" enctype="multipart/form-data">
           
            <input type="hidden" name="student_info_id" id="student_info_id" value="<?php echo $student_info_id ?>" />
            <input type="hidden" name="student_id" id="student_id" value="<?php echo $student_id ?>" />

            <div class="form-group">
				<label class="value">Subject :</label>
                <select name="subject" class="form-control" id="subject">
                        <option value="">Select one Subject</option>
                        <?php echo $subject_name; ?>
                </select>
				<span id="subjectmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
              <label  class="value"> Tution Day:</label>
                <select id="Student_tution_days" name="Student_tution_days[]" multiple class="form-control" >
                             <?php echo $student_tution_days_selected; ?>
                             <!-- <?php echo $student_tution_days_not_selected; ?> -->
                </select>
                <span id="Student_tution_daysmsg" class="text-danger "></span>
            </div>

            <div class="form-group ">
                <label for="Student_tution_time_from" class="value">Time From :</label> <?php if( isset($_SESSION['TutionTimeError']) ){
                        $msg = $_SESSION['TutionTimeError']; 
		                 echo $msg;

                         unset($_SESSION['TutionTimeError']);
                    }
                  ?>
                   <input class="form-control" type="time" value="<?php echo $tution_time_from; ?>" name="Student_tution_time_from" id="Student_tution_time_from">        
            </div>

            <div class="form-group ">
                <label for="Student_tution_time_to" class="value">Time To :</label>
                   <input class="form-control" type="time" value="<?php echo $tution_time_to; ?>" name="Student_tution_time_to" id="Student_tution_time_to">        
            </div>

            <div class="form-group">
				<label class="value">Offer Salary :</label>
                <input type="text" name="Offer_Salary" class="form-control" id="Offer_Salary" value="<?php echo $Offer_Salary; ?>" placeholder="Enter Tuition offer salary" autocomplete="off">
				<span id="Offer_Salary_msg" class="text-danger "></span>
			</div>


      </div>
    </div>

 
   <div class="flex-item">
    <div  class="col-lg-8 m-auto d-block">
            
            <div class="form-group">
				<label class="value">Student Name :</label>
				<input type="text" name="studentname" class="form-control" id="studentname" value="<?php echo $studentname; ?>" placeholder="Enter Student Name" autocomplete="off" readonly> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                 echo $msg;
                     }
                    }
                  ?>
				<span id="studentnamemsg" class="text-danger "></span>
			</div>


            <div class="form-group">
				<label class="value">Class :</label>
                <select name="studentclass" class="form-control" id="studentclass" readonly>
                       
                        <?php echo $class_name; ?>
                </select>
				<span id="studentclassmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Medium :</label>
                <select name="medium" class="form-control" id="medium" readonly>
                        
                            <?php echo $medium_name; ?>
                       
                </select>
				<span id="mediummsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Gender :</label>
                <select name="studentgender" class="form-control" id="studentgender" readonly>
                         <?php echo $gender_name; ?> 
                </select>
				<span id="studentgendermsg" class="text-danger "></span>
			</div>

            
            <div class="form-group">
				<label class="value">District :</label>
                <select name="studentDistrict" id="studentTutionDistrict" class="form-control action" readonly>
                    <?php echo $district; ?>
                </select>
				<span id="studentDistrictmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Area :</label>
                <select name="studentArea" id="studentTutionArea" class="form-control" > 
                    <option value="">Select one area</option>
                </select>
				<span id="studentAreamsg" class="text-danger "></span>
			</div>


    </div>
   </div>

</div>



     <div class="div3">
          <input type="submit" name="submit" value="submit" class="btn btn-success" id="submit" autocomplete="off">
      </form>
    </div>  
    
</div>
</body>
</html>

<script type="text/javascript">	
    //validation
    function validation()
    {
        var studentname= document.getElementById('studentname').value;
        var studentgender= document.getElementById('studentgender').value;
        var studentclass= document.getElementById('studentclass').value;
        var medium= document.getElementById('medium').value;
        var subject= document.getElementById('subject').value;
        var studentDistrict= document.getElementById('studentDistrict').value;
        var studentArea= document.getElementById('studentArea').value;
        var Offer_Salary= document.getElementById('Offer_Salary').value;
        //console.log(subject);
        
        if(Offer_Salary == 0 || Offer_Salary == null)
        {
            document.getElementById('Offer_Salary_msg').innerHTML="***Please fill the offer salary field";
            
            return false;
        }

        if(studentname == "")
        {
            document.getElementById('studentnamemsg').innerHTML="***Please fill the student name field";
            
            return false;
        }
        
        if((studentname.length<=2) || (studentname.length>20))
        {
            document.getElementById('studentnamemsg').innerHTML="*** Rule: student Name must be greater than 2 character and less than 20 character !";
            
            return false;
        }
        
        if(!isNaN(studentname))
        {
            document.getElementById('studentnamemsg').innerHTML="***Only character please";
            return false;
        }

        if(studentgender == "")
        {
            document.getElementById('studentgendermsg').innerHTML="***Please fill the student gender field";
            
            return false;
        }

        if(isNaN(studentgender))
		{
				document.getElementById('studentgendermsg').innerHTML="***Only number please";
				return false;
		}

        if(studentclass == "")
        {
            document.getElementById('studentclassmsg').innerHTML="***Please fill the student class field";
            
            return false;
        }

        if(isNaN(studentclass))
		{
				document.getElementById('studentclassmsg').innerHTML="***Only number please";
				return false;
		}

        if(medium == "")
        {
            document.getElementById('mediummsg').innerHTML="***Please fill the student medium field";
            
            return false;
        }

        if(isNaN(medium))
		{
				document.getElementById('mediummsg').innerHTML="***Only number please";
				return false;
		}

        if(subject == "")
        {
            document.getElementById('subjectmsg').innerHTML="***Please fill the student subject field";
            
            return false;
        }

        if(isNaN(subject))
		{
				document.getElementById('subjectmsg').innerHTML="***Only number please";
				return false;
		}
      
        if(studentDistrict == "")
        {
            document.getElementById('studentDistrictmsg').innerHTML="***Please fill the student District field";
            
            return false;
        }

        if(isNaN(studentDistrict))
		{
				document.getElementById('studentDistrictmsg').innerHTML="***Only number please";
				return false;
		}
      
        if(studentArea == "")
        {
            document.getElementById('studentAreamsg').innerHTML="***Please fill the student Area field";
            
            return false;
        }

        if(isNaN(studentArea))
		{
				document.getElementById('studentAreamsg').innerHTML="***Only number please";
				return false;
		}

    }
  //validation end  

$(document).ready(function(){

 //dynamicly district,area select
 fetch_data();
 
   function fetch_data()
   {
     var action = $('.action').attr("id");
     var query = $('.action').val();
     var student_info_id = $('#student_info_id').val(); 
   
    var result = '';
   if(action == "studentTutionDistrict")
   {
     result = 'studentTutionArea';
   }

   $.ajax({
       url:"Dynamic-district-area-select.php",
       method:"POST",
       data:{student_info_id:student_info_id, action:action, query:query},
            success:function(data){
              $('#'+result).html(data);
            }
       })
  }
    $('.action').change(function(){
        fetch_data();
    });
    
  
 
 //dynamicly district,area select

// image edit show start

         $("#image").change(function () {
                  readImageURL(this);
               });

          function readImageURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#view_uploading_img_src').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

// image edit show start

//  multiselete
$('#Student_tution_days').multiselect({
  nonSelectedText: 'Select Student tution days',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });

// multiselete end

});

</script>

