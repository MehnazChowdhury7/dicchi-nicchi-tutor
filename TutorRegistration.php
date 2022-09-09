<?php 
require('db_rw.php');

if(isset($_GET['status']))
{
	$status = $_GET['status'];

   echo $status;
}

 //district
 $district = '';
 $query = "SELECT id,district_name FROM district ORDER BY id ASC";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_array($result))
 {
  $district .= '<option value="'.$row["id"].'">'.$row["district_name"].'</option>';
 }
 //district end

  //studentgender
  $gender_name = '';
  $query_gender = "SELECT id,gender_name FROM gender ORDER BY id ASC";
  $result_gender = mysqli_query($conn, $query_gender);
  while($row_gender = mysqli_fetch_array($result_gender))
  {
	 $gender_name .= '<option value="'.$row_gender["id"].'" >'.$row_gender["gender_name"].'</option>';
  }   
   
  //studentgender end


?>

<html>
<head>
        <title>Tutor Registration</title>
		
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
    margin: -5px 620px;
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
    height: 530px;
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



<body>


    <div class="div1"><h1>WELLCOME TO DICCI NICCI TUTOR</h1>
 

<div class="div2">
<a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/ParentLogIn.html" class="button">Search tutor</button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/adminLogin.html" class="button">Admin</button></a>
</div>

<div>
  
<h2 class="h2"> Tutor Registration Form </h2>

<div class="flex-container">
  
  <div class="flex-item">
       <div  class="col-lg-8 m-auto d-block">
	        <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/TutorRegistrationCheck.php" onsubmit="return validation()" enctype="multipart/form-data">
            

			<div class="form-group">
				<label class="value">Gender :</label>
                <select name="tutorgender" class="form-control" id="tutorgender">
                        <option value="">Select one Gender</option>
                        <?php echo $gender_name; ?>
                </select>
				<span id="studentgendermsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">District :</label>
                <select name="TutorDistrict" id="AllDistrict" class="form-control action">
                    <option value="">Select one District</option>
                    <?php echo $district; ?>
                </select>
				<span id="studentDistrictmsg" class="text-danger "></span>
			</div>

            <div class="form-group">
				<label class="value">Area :</label>
                <select name="TutorArea" id="AllArea" class="form-control">
                    <option value="">Select one area</option>
                </select>
				<span id="studentAreamsg" class="text-danger "></span>
			</div>

			<div class="form-group">
				<label class="value">Password :</label>
				<input type="text" name="pass" class="form-control" id="pass" autocomplete="off"> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                // echo $msg;
                     }
                    }
                  ?>
				<span id="passw" class="text-danger "></span>
			</div>
			
			<div class="form-group">
				<label class="value">Confirm Password :</label>
				<input type="text" name="confpass" class="form-control" id="confpass" autocomplete="off"> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		               //  echo $msg;
                     }
                    }
                  ?>
				<span id="confpassw" class="text-danger "></span>
			</div>
    
    </div>
  </div>

  <div class="flex-item">
      <div class="container">
		<div  class="col-lg-8 m-auto d-block">
			
			<div class="form-group">
				<label class="value">User Name :</label>
				<input type="text" name="username" class="form-control" id="username" autocomplete="off"> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		               //  echo $msg;
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
                     }elseif($msg == "file-not-found"){
						echo $msg;
				    	}
						elseif($msg == "fild-empty"){
							echo $msg;
							}	
                    }
                  ?>
				</label>

                <img src="upload/parent/" width="200px" height="200px" id="view_uploading_img_src"/>  <br/>

				<span id="userimg" class="text-danger "></span>
			</div>


			
			
			<div class="form-group">
				<label class="value">Mobile Number :</label>
				<input type="text" name="mobile" class="form-control" id="mobile" autocomplete="off"> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                // echo $msg;
                     }
                    }
                  ?>
				<span id="mobilen" class="text-danger "></span>
			</div>

			<div class="form-group">
				<label class="value">Email :</label>
				<input type="text" name="email" class="form-control" id="email" autocomplete="off"> <?php if(isset($_REQUEST["status"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "this-email-is-alraedy-taken"){
		                 echo $msg;
                     }
                    }
                  ?>
				<span id="emails" class="text-danger "></span>
			</div>
			
			
		</div>
		
		<div class="div3">
          <input type="submit" name="submit" value="submit" class="btn btn-success" id="submit" autocomplete="off">
          </form>
       </div>
		
	</div>
   </div>
	
	
	<script type="text/javascript">
	
		function validation()
		{
			var user= document.getElementById('username').value;
			var pass= document.getElementById('pass').value;
			var confpass= document.getElementById('confpass').value;
			var mobile= document.getElementById('mobile').value;
			var email= document.getElementById('email').value;
			var tutorgender= document.getElementById('tutorgender').value;
			var tutorDistrict= document.getElementById('AllDistrict').value;
			var tutorArea= document.getElementById('AllArea').value;
			
			
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
			
			
			if(pass == "")
			{
				document.getElementById('passw').innerHTML="***Please fill the password field";
				
				return false;
			}
			
			if((pass.length<4) || (pass.length>20))
			{
				document.getElementById('passw').innerHTML="*** Rule: Password must be greater than 4 character and less than 20 character !";
				
				return false;
			}
			
			if(pass!=confpass)
			{
				document.getElementById('passw').innerHTML="*** Rule: Password are not match!";
				
				return false;
			
			}
			
			if(confpass == "")
			{
				document.getElementById('confpassw').innerHTML="***Please fill the confirm password field";
				
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

$(document).ready(function(){

//dynamicly district,area select
 $('.action').change(function(){
 
 if($(this).val() != '')
 {
   var action = $(this).attr("id");
   var query = $(this).val();
   //console.log(query);
   var result = '';
  if(action == "AllDistrict")
  {
	result = 'AllArea';
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

//email validation

          
$('#email').blur(function(){

var $email = $(this).val();
var $method = "tutor_email";

	$.ajax({
	url:"email_validation.php",
	method:"POST",
	data:{tutor_email:$email , method:$method},
	dataType:"text",
	success:function (data) {
		//console.log(html);
		$('#emails').html(data);

		
	}

	});

  });  


//email validation end

});
   
	
</script>




</div>

</body>
</html>
