
<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validAdmin") || isset($_COOKIE['rm']) ){
     
        $id = $_SESSION['admin_id']; 
	 
    $sql = "SELECT * FROM admin WHERE  id='$id' ";

	$result = mysqli_query($conn , $sql);
	
	if($result->num_rows != null){
		$row = mysqli_fetch_array($result);
			
		    $id = $row['id'];	
		    $name = $row['username'];
			//$password = md5($row['password']);
			$email = $row['email'];
		
	}else{
		//echo "data not edit".mysqli_error($conn);
        header('location: AdminLogin.php?status=user-not-found');
	}
		 
    }else {
        header('location: AdminLogin.php?status=invalid-creadiantial');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];

			echo $status;
		}

mysqli_close($conn);
?>



<html>
<head>
        <title>Admin home</title>
		
	
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
    width: 220px;
    height: 70px;    
    padding: 5px;
    margin: 4px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div4 {
    text-align: center;
    width: 220px;
    height: 70px;    
    padding: 5px;
    margin: -74px 225px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div5 {
    text-align: center;
    width: 210px;
    height: 70px;    
    padding: 5px;
    margin: 4px 448px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div6 {
    text-align: center;
    width: 220px;
    height: 70px;    
    padding: 5px;
    margin: 10px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div7 {
    text-align: center;
    width: 220px;
    height: 70px;    
    padding: 5px;
    margin: -80px 225px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div8 {
    text-align: center;
    width: 210px;
    height: 70px;    
    padding: 5px;
    margin: 10px 448px;
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
    height: 550px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 665px;
    height: 550px;
    margin: 2px;
}

h1 {
   color: black;
    text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

</style>

</head>
<body>

<div class="div1"><h1>DICCI NICCI TUTOR</h1></div>
<div class="div2">

<a href="http://localhost/PHP/dicchi-nicchi-tutor/dnt.html" class="button">Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Search%20a%20tutor.php" class="button">Search tutor</button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Adminhome.php" class="button">Admin Home </button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
<a href='AdminLogOut.php' class="button"> logout</a> <br/><br/>;

</div>


<div class="flex-container">
   

  <div class="flex-item">
  <h1>User Name : <?php echo $name ?> </h1> <br>
  
  </div>

<div class="flex-item">
<h1>Admin Home  </h1>
 
    <div class="container">
                <div class="div3">
                    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Admin_view_all_Payment.php" class="button">All Payment List</a> <br>
                </div>    
                <div class="div4">
                    <a  href="http://localhost/PHP/dicchi-nicchi-tutor/Admin_New_Payment.php"   class="button"> New Payment</a> </br>
                </div>
            

    </div>

</div>

</div>

</body>
</html>
