<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validTutor") || isset($_COOKIE['rm']) ){
     
        $id = $_SESSION['Tutor_id']; 

           //studentclass
           $class_name = '';
           $query_class = "SELECT id,class_name FROM class ORDER BY id ASC";
           $result_class = mysqli_query($conn, $query_class);
           while($row_class = mysqli_fetch_array($result_class))
           {
              $class_name .= '<option value="'.$row_class["id"].'" >'.$row_class["class_name"].'</option>';  
            
           }
           //studentclass end
           
           //subject
           $subject_name = '';
           $query_subject = "SELECT id,subject_name FROM subject ORDER BY id ASC";
           $result_subject = mysqli_query($conn, $query_subject);
           while($row_subject = mysqli_fetch_array($result_subject))
           {
              $subject_name .= '<option value="'.$row_subject["id"].'" >'.$row_subject["subject_name"].'</option>';
           }   
            
           //subject end
 
   
            //medium
            $medium_name = '';
            $query_medium = "SELECT id,medium_name FROM medium ORDER BY id ASC";
            $result_medium = mysqli_query($conn, $query_medium);
            while($row_medium = mysqli_fetch_array($result_medium))
            {
               $medium_name .= '<option value="'.$row_medium["id"].'" >'.$row_medium["medium_name"].'</option>';
            }   
             
            //medium end
			 
    }else {
        header('location: TutorLogin.php?status=login-first');
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
		}

mysqli_close($conn);
?>

<html>
<head>
      <title>Search a tutor</title>
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
    height: 400px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
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
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">Tution Information </h2>

<div class="flex-container">
  
  <div class="flex-item">
      <div  class="col-lg-8 m-auto d-block">
        <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Add_My_Tution_Info_Check.php" onsubmit="return validation()" enctype="multipart/form-data">

            <div class="form-group">
              <label  class="value"> Tution Day:</label>
                <select id="tutor_tution_days" name="tutor_tution_days[]" multiple class="form-control" >
                    <option value="1">Saturday</option>
                    <option value="2">Sunday</option>
                    <option value="3">Monday</option>
                    <option value="4">Tuesday</option>
                    <option value="5">Wednesday</option>
                    <option value="6">Thursday</option>
                    <option value="7">Friday</option>
                </select>
                <span id="tutor_tution_daysmsg" class="text-danger "></span>
            </div>

            <div class="form-group ">
                <label for="Tutor_tution_time_from" class="value">Time From :</label> <?php if( isset($_SESSION['TutionTimeError']) ){
                        $msg = $_SESSION['TutionTimeError']; 
		                 echo $msg;

                         unset($_SESSION['TutionTimeError']);
                    }
                  ?>
                   <input class="form-control" type="time" value="" name="Tutor_tution_time_from" id="Tutor_tution_time_from">        
            </div>

            <div class="form-group ">
                <label for="Tutor_tution_time_to" class="value">Time To :</label>
                   <input class="form-control" type="time" value="" name="Tutor_tution_time_to" id="Tutor_tution_time_to">        
            </div>

      </div>
    </div>

 
   <div class="flex-item">
    <div  class="col-lg-8 m-auto d-block">

            <div class="form-group">
				<label class="value">Medium :</label>
                <select name="medium" class="form-control" id="medium">
                        <option value="">Select one Medium</option>
                        <?php echo $medium_name; ?>
                </select>
				<span id="mediummsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Class :</label>
                <select name="TeacherClass" class="form-control" id="TeacherClass">
                       <option value="">Select one Class</option>
                       <?php echo $class_name; ?>
                </select>
				<span id="TeacherClassmsg" class="text-danger "></span>
			</div>


            <div class="form-group">
				<label class="value">Subject :</label>
                <select name="TeacherSubject" class="form-control" id="TeacherSubject">
                        <option value="">Select one Subject</option>
                        <?php echo $subject_name; ?>
                </select>
				<span id="TeacherSubjectmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Salary :</label>
                <input type="text" name="Tutor_Salary" class="form-control" id="Tutor_Salary" autocomplete="off">
				<span id="Tutor_Salary_msg" class="text-danger "></span>
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
        var TeacherClass= document.getElementById('TeacherClass').value;
        var medium= document.getElementById('medium').value;
        var TeacherSubject= document.getElementById('TeacherSubject').value;
        var Tutor_Salary= document.getElementById('Tutor_Salary').value;
      

        if(Tutor_Salary == "")
        {
            document.getElementById('Tutor_Salary_msg').innerHTML="***Please fill the expected salary field";
            
            return false;
        }
        
        if((Tutor_Salary.length<=2) || (Tutor_Salary.length>5))
        {
            document.getElementById('Tutor_Salary_msg').innerHTML="*** Rule: expected salary must be greater than 2 digites and less than 6 digites !";
            
            return false;
        }
        
        if(isNaN(Tutor_Salary))
        {
            document.getElementById('Tutor_Salary_msg').innerHTML="***Only number please";
            return false;
        }

       
        if(TeacherClass == "")
        {
            document.getElementById('TeacherClassmsg').innerHTML="***Please fill the student class field";
            
            return false;
        }

        if(isNaN(TeacherClass))
		{
				document.getElementById('TeacherClassmsg').innerHTML="***Only number please";
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

        if(TeacherSubject == "")
        {
            document.getElementById('TeacherSubjectmsg').innerHTML="***Please fill the student subject field";
            
            return false;
        }

        if(isNaN(TeacherSubject))
		{
				document.getElementById('TeacherSubjectmsg').innerHTML="***Only number please";
				return false;
		}
      
    

    }
  //validation end  

$(document).ready(function(){

 //dynamicly district,area select
  $('.action').change(function(){
  
  if($(this).val() != '')
  {
    var action = $(this).attr("id");
    var query = $(this).val();
    //console.log(query);
    var result = '';
   if(action == "studentDistrict")
   {
     result = 'studentArea';
   }

   $.ajax({
       url:"Dynamic-district-area-select.php",
       method:"POST",
       data:{action:action, query:query},
            success:function(data){
              $('#'+result).html(data);
            }
       })
  }
 
 });
 //dynamicly district,area select

 //  multiselete
    $('#tutor_tution_days').multiselect({
        nonSelectedText: 'Select tution days',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'400px'
    });

// multiselete end

});

</script>

