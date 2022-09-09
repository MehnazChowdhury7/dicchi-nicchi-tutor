<?php
session_start();

	if(isset($_COOKIE['rm']) && ($_SESSION['abc'] == "validTutor"))
	{
		header("location: Tutorhome.php");
	}else
	{

		if(isset($_REQUEST['status']))
		{
			$status = $_REQUEST['status'];

		   echo $status;
    }   
    
	}

?>

<html>
<head>
      <title>Tutor LogIn</title>
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
            height: 450px;
            background-color: grey;
        }
        
        .flex-item {
            background-color: lightgrey;
            width: 665px;
            height: 450px;
            margin: 2px;
        }
        
        
        video {
            max-width: 100%;
            autoplay;
        }
        h1 {
           color: black;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }
        h2{
          text-align:center;
          float:center;
        }
        
        </style>

</head>
<body>

<form method="POST" action="TutorLoginChack.php">

<div>
  <div class="div1"><h1>WELLCOME TO DICCI NICCI TUTOR</h1>
</div>

<div>
<div class="div2">
<a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/ParentLogin.php" class="button">Search tutor</button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a>
<a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a>
</div>

<div class="flex-container">
  
  <div class="flex-item">
  
  </div>

  
  <div class="flex-item">
  
  <h2>PLEASE SIGNIN OR SIGNUP YOUR ID </h2>
   <h2>***If yor are a registered mumber*** </h2>

  <div class="container">
  

  <div  class="col-lg-8 m-auto d-block">
    <form method="POST" action="TutorLoginChack.php">

        <h3> Email  :</h3>
        <h3><input type="text" name="tID" ></h3> 
        
        <h3>PASSWORD:</h3>
        <h3><input type="password" name="password"></h3>
        
        <input type="checkbox" name="rm" /> Remember Me<br/>
  
       <h3><input type="submit" name="submit" value="Submit"><h3>
  

        <h3>If yor are a new mumber </h3>
        <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorRegistration.php" class="button">Registration</button></a>
            
	  
	</form>
	
   </div>
   </div>   
  </div> 

</div>

</body>
</html>
