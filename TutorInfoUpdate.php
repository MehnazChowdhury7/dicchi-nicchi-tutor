<?php 
require('db_rw.php');
session_start();


if( ($_SESSION["abc"] == "validTutor") || isset($_COOKIE['rm']) ){

	 
	$id = $_SESSION['Tutor_id'];  
	 
    $sql = "SELECT * FROM tutorregistration WHERE  id='$id' ";

	$result = mysqli_query($conn , $sql);
	
	if($result->num_rows != null){
		$row = mysqli_fetch_array($result);
			
		    $id = $row['id'];	
		    $name = $row['username'];
			$password = md5($row['password']);
			$email = $row['email'];
			$mobile = $row['mobile'];
			$image  = $row['image'];
			$tutor_status = $row['status'];
			$tutorgender = $row['tutorgender'];
			$TutorDistrict = $row['TutorDistrict'];
			$TutorArea  = $row['TutorArea'];
		
	}else{
		header('location: TutorLogin.php?status=user-not-found');
	}
		 
  }else {
	header('location: TutorLogin.php?status=invalid-creadiantial');
  }
     
    //for msg
        if(isset($_GET['status']))
		{
			$status = $_GET['status'];

			echo $status;
		}
    //msg end		
	
	//tutor status
	 if($tutor_status == 1){
	   $tutor_status .= '<option value="'.$tutor_status.'" selected="selected" >Available</option>
	                     <option value="0" > Not Available </option>';
	 }elseif($tutor_status == 0){
	   $tutor_status .= '<option value="'.$tutor_status.'" selected="selected" > Not Available</option>
	                     <option value="1" > Available </option>';
	 }
	//tutor status end

	//studentgender
	$gender_name = '';
	$query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
	$result_gender = mysqli_query($conn, $query_gender);
	while($row_gender = mysqli_fetch_array($result_gender))
	{
	 $gender_id = $row_gender["id"];
	 if($gender_id == $tutorgender){
	   $gender_name .= '<option value="'.$row_gender["id"].'" selected="selected" >'.$row_gender["gender_name"].'</option>';
	 }else{
	   $gender_name .= '<option value="'.$row_gender["id"].'" >'.$row_gender["gender_name"].'</option>';
	 }   
	 
	}
	//studentgender end

	//district
	$district = '';
	$query = "SELECT id,district_name FROM district ORDER BY id ASC";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result))
	{
		$district_id = $row["id"];
		if($district_id == $TutorDistrict){
			$district .= '<option value="'.$row["id"].'" selected="selected" >'.$row["district_name"].'</option>';
		  }else{
			$district .= '<option value="'.$row["id"].'">'.$row["district_name"].'</option>';
		  }
	 
	}
	//district end

mysqli_close($conn);	
?>


<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

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
    margin: -30px 610px;
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
    height: 480px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 430px;
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
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.php" class="button">Search tution</button></a> -->
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/adminLogin.php" class="button">Admin</button></a>

</div>

<h2 class="h2"> Tutor Info Update </h2>

<div class="flex-container">

  <div class="flex-item">
      <div  class="col-lg-8 m-auto d-block">
  
          <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/TutorInfoUpdateChack.php" onsubmit="return validation()" enctype="multipart/form-data">
            
			<div class="form-group">
				<label class="value">Status :</label>
                <select name="tutor_status" class="form-control" id="tutor_status">
                   <option value="">Select status</option>
                      
                                  <?php echo $tutor_status; ?>
                     
                </select>
				<span id="studentgendermsg" class="text-danger "></span>
			</div>

			<div class="form-group">
				<label class="value">Gender :</label>
                <select name="tutorgender" class="form-control" id="tutorgender">
                   <option value="">Select one Gender</option>
                      
                                  <?php echo $gender_name; ?>
                    </option>
                                                              ?> 
                </select>
				<span id="studentgendermsg" class="text-danger "></span>
			</div>

			<div class="form-group">
				<label class="value">District :</label>
                <select name="TutorDistrict" id="tutorDistrict" class="form-control action">
                    <option value="">Select one District</option>
                    <?php echo $district; ?>
                </select>
				<span id="studentDistrictmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Area :</label>
                <select name="TutorArea" id="tutorArea" class="form-control">
                    <option value="">Select one area</option>
                </select>
				<span id="studentAreamsg" class="text-danger "></span>
			</div>

	  </div>
  </div>

  <div class="flex-item">
  
  <div class="container">
    <div  class="col-lg-8 m-auto d-block">
  		
            <input type="hidden" name="tutor_id" id="tutor_id" value="<?php echo $id; ?>" />

			<div class="form-group">
				<label class="value">User Name :</label>
				<input type="text" name="username" class="form-control" id="username" value="<?php echo $name; ?>" autocomplete="off"> <?php if(isset($_REQUEST["msg"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                 echo $msg;
                     }
                    }
                  ?>
				<span id="usern" class="text-danger "></span>
			</div>

			<div class="form-group">
				<label class="value"> Image (must be a jpg file) :
				<input type="file" name="image" id="image" />   <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "is-not-a-valid-file"){
		                 echo $msg;
                     }
                    }
                  ?>
                </label>  

                <input type="hidden" name="old_image" value="<?php echo $image; ?>" />
                <img src="upload/tutor/<?php echo $image; ?>" width="300px" height="100px" id="view_uploading_img_src"/>  <br/>

				<span id="userimg" class="text-danger "></span>

			</div>
			
			
			<div class="form-group">
				<label class="value">Mobile Number :</label>
				<input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $mobile; ?>" autocomplete="off"> <?php if(isset($_REQUEST["msg"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                 echo $msg;
                     }
                    }
                  ?>
				<span id="mobilen" class="text-danger "></span>
			</div>

			
			<div class="form-group">
				<label class="value">Email :</label>
				<input type="text" name="email" class="form-control" id="email" value="<?php echo $email; ?>" autocomplete="off"> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
					 if($msg == "this-email-is-alraedy-taken"){
						echo $msg;
				      }
                    }
                  ?>
				<span id="emails" class="text-danger "></span>
			</div>

	
<br>
    </div>

	   <div class="div3">
          <input type="submit" name="submit" value="submit" class="btn btn-success" id="submit" autocomplete="off">
          </form>
       </div>

</div>

<script type="text/javascript">
	
		function validation()
		{
			var user= document.getElementById('username').value;
			var mobile= document.getElementById('mobile').value;
			var email= document.getElementById('email').value;
            var tutorDistrict= document.getElementById('tutorDistrict').value;
			var tutorArea= document.getElementById('tutorArea').value;
			var tutorgender= document.getElementById('tutorgender').value;
			console.log(tutorgender);
			
			if(user == "")
			{
				document.getElementById('usern').innerHTML="***Please fill the username field";
				
				return false;
			}
			
			if((user.length<=2) || (user.length>20))
			{
				document.getElementById('usern').innerHTML="*** Rule: User Name must be greater than 2 character and less than 20 character !";
				
				return false;
			}
			
			if(!isNaN(user))
			{
				document.getElementById('usern').innerHTML="***Only character please";
				return false;
			}
			
			
			if(mobile == "")
			{
				document.getElementById('mobilen').innerHTML="***Please fill the mobile number field";
				
				return false;
			}
			
			if(isNaN(mobile))
			{
				document.getElementById('mobilen').innerHTML="***Only number please";
				return false;
			}
			
			if((mobile.length!=11))
			{
				document.getElementById('mobilen').innerHTML="*** Rule: Must be 11 digit !";
				
				return false;
			}

			if(email == "")
			{
				document.getElementById('emails').innerHTML="***Please fill the email id field";
				
				return false;
			}
			
			if(email.indexOf('@') <=0)
			{
				document.getElementById('emails').innerHTML="***Incorrect email id !";
				
				return false;
			}
			
			if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.'))
			{
				document.getElementById('emails').innerHTML="***Incorrect email id !";
				
				return false;
			}

			if(tutorDistrict == "")
			{
				document.getElementById('studentDistrictmsg').innerHTML="***Please fill the tutor District field";
				
				return false;
			}

			if(isNaN(tutorDistrict))
			{
					document.getElementById('studentDistrictmsg').innerHTML="***Only number please";
					return false;
			}
		
			if(tutorArea == "")
			{
				document.getElementById('studentAreamsg').innerHTML="***Please fill the tutor Area field";
				
				return false;
			}

			if(isNaN(tutorArea))
			{
					document.getElementById('studentAreamsg').innerHTML="***Only number please";
					return false;
			}

			if(tutorgender == "")
			{
				document.getElementById('studentgendermsg').innerHTML="***Please fill the tutor gender field";
				
				return false;
			}

			if(isNaN(tutorgender))
			{
					document.getElementById('studentgendermsg').innerHTML="***Only number please";
					return false;
			}
				
		}

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

$(document).ready(function(){

		//dynamicly district,area select
		fetch_data();

		function fetch_data()
		{
			var action = $('.action').attr("id");
			var query = $('.action').val();
			var tutor_id = $('#tutor_id').val(); 
		
		var result = '';
		if(action == "tutorDistrict")
		{
			result = 'tutorArea';
		}

		$.ajax({
			url:"Dynamic-district-area-select.php",
			method:"POST",
			data:{tutor_id:tutor_id, action:action, query:query},
				success:function(data){
					$('#'+result).html(data);
				}
			})
		}
		$('.action').change(function(){
			fetch_data();
		});
		
		

		//dynamicly district,area select
});
	
	
	</script>





</div>

</body>
</html>
