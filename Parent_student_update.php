<?php
	require('db_rw.php');
    session_start();
    

	if( ($_SESSION['abc'] == "validParent") || ($_SESSION['abc'] == "validAdmin") || isset($_COOKIE['rm']) ){
     
        //$id = $_SESSION['id'];

        if(isset($_GET['std_id'])){

            $id = $_GET['std_id'];
            
            $sql = "SELECT * FROM student WHERE  id='$id' ";
            
            $result = mysqli_query($conn , $sql);

            if($result->num_rows != null){
                $row = mysqli_fetch_array($result);
                    
                    $id = $row['id'];	
                    $studentname = $row['studentname'];
                    $studentimage  = $row['studentimage'];
                    $studentgender  = $row['studentgender'];
                    $medium  = $row['medium'];
                    $studentclass  = $row['studentclass'];
                    $studentDistrict  = $row['studentDistrict'];
                   
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
         }else{
           $class_name .= '<option value="'.$row_class["id"].'" >'.$row_class["class_name"].'</option>';
         }   
         
        }
        //studentclass end

        

         //studentgender
         $gender_name = '';
         $query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
         $result_gender = mysqli_query($conn, $query_gender);
         while($row_gender = mysqli_fetch_array($result_gender))
         {
          $gender_id = $row_gender["id"];
          if($gender_id == $studentgender){
            $gender_name .= '<option value="'.$row_gender["id"].'" selected="selected" >'.$row_gender["gender_name"].'</option>';
          }else{
            $gender_name .= '<option value="'.$row_gender["id"].'" >'.$row_gender["gender_name"].'</option>';
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
          }else{
            $medium_name .= '<option value="'.$row_medium["id"].'" >'.$row_medium["medium_name"].'</option>';
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
              }else{
                $district .= '<option value="'.$row["id"].'">'.$row["district_name"].'</option>';
              }
         
        }
        //district end

			 
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
      <title>student info update</title>
    
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
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">Student Information Update</h2>

<div class="flex-container">
  
  <div class="flex-item">
      <div  class="col-lg-8 m-auto d-block">
        <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Parent_student_update_check.php" onsubmit="return validation()" enctype="multipart/form-data">
           
            <input type="hidden" name="student_id" id="student_id" value="<?php echo $id ?>" />
            
            <div class="form-group">
				<label class="value">Class :</label>
                <select name="studentclass" class="form-control" id="studentclass">
                       <option value="">Select one Class</option>
                        <?php echo $class_name; ?>
                </select>
				<span id="studentclassmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Medium :</label>
                <select name="medium" class="form-control" id="medium">
                        <option value="">Select one Medium</option>
                            <?php echo $medium_name; ?>
                        </option>
                </select>
				<span id="mediummsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">District :</label>
                <select name="studentDistrict" id="studentDistrict" class="form-control action">
                    <option value="">Select one District</option>
                    <?php echo $district; ?>
                </select>
				<span id="studentDistrictmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Area :</label>
                <select name="studentArea" id="studentArea" class="form-control">
                    <option value="">Select one area</option>
                </select>
				<span id="studentAreamsg" class="text-danger "></span>
			</div>

      </div>
    </div>

 
   <div class="flex-item">
    <div  class="col-lg-8 m-auto d-block">
            
            <div class="form-group">
				<label class="value">Student Name :</label>
				<input type="text" name="studentname" class="form-control" id="studentname" value="<?php echo $studentname; ?>" placeholder="Enter Student Name" autocomplete="off" > <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                 echo $msg;
                     }
                    }
                  ?>
				<span id="studentnamemsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value"> Image (must be a jpg file) :
				<input type="file" name="studentimage" id="image" />   <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "is-not-a-valid-file"){
		                 echo $msg;
                     }
                    }
                  ?>
                </label>  

                <input type="hidden" name="old_image" value="<?php echo $studentimage; ?>" />
                <img src="upload/student/<?php echo $studentimage; ?>" width="300px" height="100px" id="view_uploading_img_src"/>  <br/>

				<span id="studentimagemsg" class="text-danger "></span>

			</div>


            <div class="form-group">
				<label class="value">Gender :</label>
                <select name="studentgender" class="form-control" id="studentgender">
                   <option value="">Select one Gender</option>
                      
                                  <?php echo $gender_name; ?>
                    </option>
                                                              ?> 
                </select>
				<span id="studentgendermsg" class="text-danger "></span>
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
        var studentDistrict= document.getElementById('studentDistrict').value;
        var studentArea= document.getElementById('studentArea').value;
        //console.log(subject);
        
     
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



});

</script>

