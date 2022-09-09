<?php
require('db_rw.php');

	session_start();
	
	if(isset($_POST['submit'])){

		$email = $_POST['tID'];
		$password = $_POST['password'];
		

		$isValid = "";

		 if( $email != null && $password != null ){
				$sql = "SELECT * FROM `ParentRegistration` WHERE email='$email'";
				$result = mysqli_query($conn , $sql);
		
		  if($result->num_rows != null){
			
			 while($row = mysqli_fetch_assoc($result)){
				 if($row['email'] == $email && md5($password) == $row['password']){

		            $id = $row['id'];

					$_SESSION['abc'] = "validParent";
					$_SESSION['id'] = $id;

					$isValid = "valid";
					
					if($_POST['rm']=="on"){
						setcookie("rm", "valid", time()+3600,'/');
					}

					$cookie_name = "abc";
					setcookie($cookie_name, $email, time()+3600,'/');

					header('location: Parenthome.php');

							 
				}else{
					
					header('location: ParentLogin.php?status=invalid-creadiantial');
				}
			 }
		  }else{
			//$error = mysqli_error($conn);
			header('location: ParentLogin.php?status=user-not-found');
		  }  
	
			
		}else{
			header("location: ParentLogin.php?status=nullvalue");
			
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