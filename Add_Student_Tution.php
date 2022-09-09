<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validParent") || isset($_COOKIE['rm']) ){
     
        $id = $_SESSION['id']; 
            //student 
                $parent_id = $_SESSION['id'];
                                
                $student_query = "SELECT * FROM student WHERE  parent_id='$parent_id' AND status=1 AND is_admin_approve=1 ";
                $student_result = mysqli_query($conn, $student_query);
                
                $Student_matching = 0;
                $student_name = '';

                while($student_row = mysqli_fetch_array($student_result))
                {
                    $student_name .= '<option value="'.$student_row["id"].'">'.$student_row["studentname"].'</option>';

                    $Student_matching++; 
                    
                }

                if($Student_matching == 0){
                    $student_name .= '<option value="none"> You Have No Student</option>';
                }
            //student  end
	  
    

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
    height: 380px;
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
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php" class="button">Parent Home</button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">Student Information </h2>

<div class="flex-container">
  
  <div class="flex-item">
      <div  class="col-lg-8 m-auto d-block">
        <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Add_Student_Tution_Check.php" onsubmit="return validation()" enctype="multipart/form-data" >
       

            <div class="form-group">
              <label  class="value"> Tution Day:</label>
                <select id="Student_tution_days" name="Student_tution_days[]" multiple class="form-control" >
                    <option value="1">Saturday</option>
                    <option value="2">Sunday</option>
                    <option value="3">Monday</option>
                    <option value="4">Tuesday</option>
                    <option value="5">Wednesday</option>
                    <option value="6">Thursday</option>
                    <option value="7">Friday</option>
                </select>
                <span id="Student_tution_daysmsg" class="text-danger "></span>
            </div>

            <div class="form-group ">
                <label for="Student_tution_time_from" class="value">Time From :</label>  <?php if( isset($_SESSION['TutionTimeError']) ){
                        $msg = $_SESSION['TutionTimeError']; 
		                 echo $msg;

                         unset($_SESSION['TutionTimeError']);
                    }
                  ?>
                   <input class="form-control" type="time" value="" name="Student_tution_time_from" id="Student_tution_time_from">        
            </div>

            <div class="form-group ">
                <label for="Student_tution_time_to" class="value">Time To :</label>
                   <input class="form-control" type="time" value="" name="Student_tution_time_to" id="Student_tution_time_to">        
            </div>
            

            

      </div>
    </div>

 
   <div class="flex-item">
    <div  class="col-lg-8 m-auto d-block">
            
            <div class="form-group">
				<label class="value">Student Name :</label>
                    <select class="form-control" name="student_id" id="student_id">
                        <option value="none">Select One Student Name</option>
                        <?php
                            echo $student_name; 
                        ?>  
                    </select>
                    <span id="studentnamemsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Subject :</label>
                <select name="subject" class="form-control" id="subject">
                        <option value="">Select one Subject</option>
                        <?php echo $subject_name; ?>
                </select>
				<span id="subjectmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Offer Salary :</label>
                <input type="text" name="Offer_Salary" class="form-control" id="Offer_Salary" autocomplete="off">
				<span id="Offer_Salary_msg" class="text-danger "></span>
			</div>
         

    </div>
   </div>

</div>



     <div class="div3">
          <input type="submit" name="submit" value="submit" class="btn btn-success" id="submit" autocomplete="off">
      </form>
    </div>  
    

</body>
</html>

<script type="text/javascript">	
    //validation
    function validation()
    {
        var studentname= document.getElementById('studentname').value;
       // var studentgender= document.getElementById('studentgender').value;
      //  var studentclass= document.getElementById('studentclass').value;
      //  var medium= document.getElementById('medium').value;
        var subject= document.getElementById('subject').value;
      //  var studentDistrict= document.getElementById('AllDistrict').value;
      //  var studentArea= document.getElementById('AllArea').value;
        var Offer_Salary= document.getElementById('Offer_Salary').value;

        if(studentname == "none")
        {
            document.getElementById('studentnamemsg').innerHTML="***Please fill the student name field";
            
            return false;
        }
        

        if(Offer_Salary == "")
        {
            document.getElementById('Offer_Salary_msg').innerHTML="***Please fill the offer salary field";
            
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
     
     

    }
  //validation end  

$(document).ready(function(){

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

