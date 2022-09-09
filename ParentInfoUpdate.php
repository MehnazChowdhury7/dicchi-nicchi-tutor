<?php 
require('db_rw.php');
session_start();


if( ($_SESSION["abc"] == "validParent") || isset($_COOKIE['rm']) ){

	 
	$id = $_SESSION['id']; 
	 
    $sql = "SELECT * FROM parentregistration WHERE  id='$id' ";

	$result = mysqli_query($conn , $sql);
	
	if($result->num_rows != null){
		$row = mysqli_fetch_array($result);
			
		    $id = $row['id'];	
		    $name = $row['username'];
			$password = md5($row['password']);
			$email = $row['email'];
			$mobile = $row['mobile'];
			$image  = $row['image'];
			$parent_status  = $row['status'];
		
	}else{
		header('location: ParentLogin.php?status=user-not-found');
	}
		 
  }else {
	header('location: ParentLogin.php?status=invalid-creadiantial');
  }

    //parent status
	 if($parent_status == 1){
		$parent_status .= '<option value="'.$parent_status.'" selected="selected" >Available</option>
						  <option value="0" > Not Available </option>';
	  }elseif($parent_status == 0){
		$parent_status .= '<option value="'.$parent_status.'" selected="selected" > Not Available</option>
						  <option value="1" > Available </option>';
	  }
	 //parent status end

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
			}
		}
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
    margin: -10px 610px;
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
    height: 330px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 270px;
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
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.php" class="button">Search tution</button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/adminLogin.php" class="button">Admin</button></a> -->

</div>

<h1 class="h2">Parent Info Update  </h1>

<div class="flex-container">

  <div class="flex-item">
        <div  class="col-lg-8 m-auto d-block">
		 <form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/ParentInfoUpdateChack.php" onsubmit="return validation()" enctype="multipart/form-data">

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
                <img src="upload/parent/<?php echo $image; ?>" width="300px" height="100px" id="view_uploading_img_src"/>  <br/>

				<span id="userimg" class="text-danger "></span>

			</div>

			<div class="form-group">
				<label class="value">Status :</label>
                <select name="parent_status" class="form-control" id="parent_status">
                   <option value="">Select status</option>
                      
                                  <?php echo $parent_status; ?>
                     
                </select>
				<span id="studentgendermsg" class="text-danger "></span>
			</div>
	    </div>		
  
  </div>

  <div class="flex-item">
  <div class="container">
    <div  class="col-lg-8 m-auto d-block">

            <input type="hidden" name="id" value="<?php echo $id; ?>" />

			<div class="form-group">
				<label class="value">User Name :</label>
				<input type="text" name="username" class="form-control" id="username" value="<?php echo $name; ?>" autocomplete="off"> <?php if(isset($_REQUEST["msg"])){
                     $msg = $_REQUEST["status"];
                     if($msg == "fild-empty"){
		                // echo $msg;
                     }
                    }
                  ?>
				<span id="usern" class="text-danger "></span>
			</div>
			
			
			<div class="form-group">
				<label class="value">Mobile Number :</label>
				<input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $mobile; ?>" autocomplete="off"> <?php if(isset($_REQUEST["msg"])){
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

<!-- <input type="submit" name="submit" value="submit" class="btn btn-success" autocomplete="off">

</form> -->

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
            console.log(user);
			
			
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
	
	
	</script>





</div>

</body>
</html>
