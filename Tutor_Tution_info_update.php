<?php
	require('db_rw.php');
    session_start();
    

	if( ($_SESSION['abc'] == "validTutor") || isset($_COOKIE['rm']) ){
     
        //$id = $_SESSION['id'];

        if(isset($_REQUEST['tutor_tution_info_id'])){

            $tutor_tution_info_id = $_REQUEST['tutor_tution_info_id'];
            
            $sql = "SELECT * FROM tution_info WHERE  id='$tutor_tution_info_id' ";
            
            $result = mysqli_query($conn , $sql);

            if($result->num_rows != null){
                $row = mysqli_fetch_array($result);
                    
                    $id = $row['id'];	
                    $Tution_tutor_id = $row['tutor_id'];
                    $Tution_tutor_medium  = $row['medium'];
                    $Tution_TeacherClass  = $row['TeacherClass'];
                    $Tution_TeacherSubject  = $row['TeacherSubject'];
                    $Tution_Tutor_Salary  = $row['Tutor_Salary'];
                    $Tution_Tutor_status  = $row['status'];
                    $tutor_tution_days  = $row['tutor_tution_days'];
                    $tutor_tution_time_from  = $row['tutor_tution_time_from'];
                    $tutor_tution_time_to  = $row['tutor_tution_time_to'];  
                
            }else{
               
                header('location: Tutor_Tution_info_update.php?status=tutor_not_found');
            }
        }else {
           
            header('location: Tutor_Tution_info_update.php?status=tutor_not_found');
        } 

        //Tution_TeacherClass
        $class_name = '';
        $query_class = "SELECT id,class_name FROM class ORDER BY id ASC";
        $result_class = mysqli_query($conn, $query_class);
        while($row_class = mysqli_fetch_array($result_class))
        {
         $class_id = $row_class["id"];
         if($class_id == $Tution_TeacherClass){
           $class_name .= '<option value="'.$row_class["id"].'" selected="selected" >'.$row_class["class_name"].'</option>';
         }else{
           $class_name .= '<option value="'.$row_class["id"].'" >'.$row_class["class_name"].'</option>';
         }   
         
        }
        //Tution_TeacherClass end

        
        //Tution_TeacherSubject
        $subject_name = '';
        $query_subject = "SELECT id,subject_name FROM subject ORDER BY id ASC";
        $result_subject = mysqli_query($conn, $query_subject);
        while($row_subject = mysqli_fetch_array($result_subject))
        {
         $subject_id = $row_subject["id"];
         if($subject_id == $Tution_TeacherSubject){
           $subject_name .= '<option value="'.$row_subject["id"].'" selected="selected" >'.$row_subject["subject_name"].'</option>';
         }else{
           $subject_name .= '<option value="'.$row_subject["id"].'" >'.$row_subject["subject_name"].'</option>';
         }   
         
        }
        //Tution_TeacherSubject end


         //Tution_tutor_medium
         $medium_name = '';
         $query_medium = "SELECT id,medium_name FROM medium ORDER BY id ASC";
         $result_medium = mysqli_query($conn, $query_medium);
         while($row_medium = mysqli_fetch_array($result_medium))
         {
          $medium_id = $row_medium["id"];
          if($medium_id == $Tution_tutor_medium){
            $medium_name .= '<option value="'.$row_medium["id"].'" selected="selected" >'.$row_medium["medium_name"].'</option>';
          }else{
            $medium_name .= '<option value="'.$row_medium["id"].'" >'.$row_medium["medium_name"].'</option>';
          }   
          
         }
         //Tution_tutor_medium end


        // tutor tution days
        $tution_days = explode(',', $tutor_tution_days);

        $tutor_tution_days_selected = '';
        $query = "SELECT id,day_name FROM days ORDER BY id ASC";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($result))
        {
            $day_id = $row["id"];
            $tutor_tution_days_selected .= ' <option value=" ';
            $tutor_tution_days_selected .= $row["id"]. ' " ';
            foreach ($tution_days as $tution_day) {
                if($day_id == $tution_day){
                    $tutor_tution_days_selected .= ' selected="selected" ';
                }
            }
            $tutor_tution_days_selected .= '>'  .$row["day_name"].'</option>';
        }
        

        // tutor tution days end
			 
    }else {
        header('location: TutorLogin.php?status=login-first');
    }
	
	if(isset($_SESSION['status']))
		{
			$status = $_SESSION['status'];

			echo $status;
		}

mysqli_close($conn);
?>

<html>
<head>
      <title>tution info update</title>
    
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
    height: 370px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 330px;
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
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">Tutor Tution Information Update</h2>

<div class="flex-container">
  
  <div class="flex-item">
      <div  class="col-lg-8 m-auto d-block">
        <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Tutor_tution_info_update_check.php" onsubmit="return validation()" enctype="multipart/form-data">
           
            <input type="hidden" name="tutor_id" id="tutor_id" value="<?php echo $Tution_tutor_id ?>" />
            <input type="hidden" name="tutor_tution_info_id" id="tutor_tution_info_id" value="<?php echo $id ?>" />
            
            <div class="form-group">
              <label  class="value"> Tution Day:</label>
                <select id="Tutor_tution_days" name="Tutor_tution_days[]" multiple class="form-control" >
                             <?php echo $tutor_tution_days_selected; ?>
                             
                </select>
                <span id="Tutor_tution_daysmsg" class="text-danger "></span>
            </div>

            <div class="form-group ">
                <label for="Tutor_tution_time_from" class="value">Time From :</label> <?php if( isset($_SESSION['TutionTimeError']) ){
                        $msg = $_SESSION['TutionTimeError']; 
		                 echo $msg;

                         unset($_SESSION['TutionTimeError']);
                    }
                  ?>
                   <input class="form-control" type="time" value="<?php echo $tutor_tution_time_from; ?>" name="Tutor_tution_time_from" id="Tutor_tution_time_from">        
            </div>

            <div class="form-group ">
                <label for="Tutor_tution_time_to" class="value">Time To :</label>
                   <input class="form-control" type="time" value="<?php echo $tutor_tution_time_to; ?>" name="Tutor_tution_time_to" id="Tutor_tution_time_to">        
            </div>



      </div>
    </div>

 
   <div class="flex-item">
    <div  class="col-lg-8 m-auto d-block">

            <div class="form-group">
				<label class="value">Class :</label>
                <select name="Tutorclass" class="form-control" id="Tutorclass">
                       <option value="">Select one Class</option>
                        <?php echo $class_name; ?>
                </select>
				<span id="Tutorclasssmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Medium :</label>
                <select name="tutor_medium" class="form-control" id="tutor_medium">
                        <option value="">Select one Medium</option>
                            <?php echo $medium_name; ?>
                        </option>
                </select>
				<span id="tutor_mediummsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Subject :</label>
                <select name="tutor_subject" class="form-control" id="tutor_subject">
                        <option value="">Select one Subject</option>
                        <?php echo $subject_name; ?>
                </select>
				<span id="tutor_subjectmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">expected Salary :</label>
                <input type="text" name="expected_Salary" class="form-control" id="expected_Salary" value="<?php echo $Tution_Tutor_Salary; ?>" placeholder="Enter Tuition expected salary" autocomplete="off">
				<span id="expected_Salary_msg" class="text-danger "></span>
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
     var student_id = $('#student_id').val(); 
   
    var result = '';
   if(action == "studentDistrict")
   {
     result = 'studentArea';
   }

   $.ajax({
       url:"Dynamic-district-area-select.php",
       method:"POST",
       data:{student_id:student_id, action:action, query:query},
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
$('#Tutor_tution_days').multiselect({
  nonSelectedText: 'Select tution days',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });

// multiselete end

});

</script>

