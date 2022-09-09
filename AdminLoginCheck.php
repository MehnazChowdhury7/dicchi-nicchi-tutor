<?php
require('db_rw.php');

	session_start();
	
	if(isset($_POST['submit'])){

		$email = $_POST['ID'];
		$password = $_POST['password'];
		

		$isValid = "";

		 if( $email != null && $password != null ){
				$sql = "SELECT * FROM `admin` WHERE email='$email'";
				$result = mysqli_query($conn , $sql);
		
		  if($result->num_rows != null){
			
			 while($row = mysqli_fetch_assoc($result)){
				 if($row['email'] == $email && md5($password) == $row['password']){

		            $id = $row['id'];

					$_SESSION['abc'] = "validAdmin";
					$_SESSION['admin_id'] = $id;

					$isValid = "valid";
					
					if($_POST['rm']=="on"){
						setcookie("rm", "valid", time()+3600,'/');
					}

					$cookie_name = "abc";
					setcookie($cookie_name, $email, time()+3600,'/');

					header('location: Adminhome.php');

							 
				}else{
					
					header('location: AdminLogin.php?status=invalid-creadiantial');
				}
			 }
		  }else{
			//$error = mysqli_error($conn);
			header('location: AdminLogin.php?status=user-not-found');
		  }  
	
			
		}else{
			header("location: AdminLogin.php?status=nullvalue");
			
		}
		
			// if($isValid == "valid"){
			// 	header("location: Parenthome.php");
			// }else{
			// 	header("location: ParentLogin.php?status=invaliduser");
			// }
			

	}else{
		echo "invalid Reguest!";
	}

mysqli_close($conn);	
	
?>