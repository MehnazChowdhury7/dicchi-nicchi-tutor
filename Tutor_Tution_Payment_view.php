
<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validTutor") || isset($_COOKIE['rm']) ){
     
        $tution_id = $_POST["tution_id"];
        $tutor_id = $_POST["tutor_id"];
        $tution_info_id = $_POST["tution_info_id"];
        $parent_id = $_POST["parent_id"];
        $Offer_Salary = $_POST["Offer_Salary"];

        $student_id = $_POST["student_id"];
        $student_name = $_POST["student_name"];

        
        $class_name = $_POST["class_name"];
        $subject_name = $_POST["subject_name"];
        $medium_name = $_POST["medium_name"];

         // tutor info 
         $sql_tutor = "SELECT * FROM parentregistration WHERE  id='$parent_id' ";

         $result_tutor = mysqli_query($conn , $sql_tutor);
         
         if($result_tutor->num_rows != null){
             $row_tutor = mysqli_fetch_array($result_tutor);
                 
                 $parent_name = $row_tutor['username'];
             
         }else{
             //echo "data not edit".mysqli_error($conn);
             header('location: ParentLogin.php?status=tutor-not-found');
         }
         // tutor info end
            
            
    }else {
        header('location: ParentLogin.php?status=invalid-creadiantial');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];

			echo $status;
		}

?>



<html>
<head>
        <title>Parent home</title>

        <script src="js/jquery-1.10.2.min.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">

		
	
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
    width: 310px;
    height: 280px;    
    padding: 5px;
    margin: 4px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div4 {
    text-align: center;
    width: 310px;
    height: 280px;    
    padding: 5px;
    margin: -285 320px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div5 {
    text-align: center;
    width: 310px;
    height: 170px;    
    padding: 5px;
    margin: 310px 320px;
    border: 1px solid red;
    box-sizing: border-box;
	}
.div6 {
    text-align: center;
    width: 310px;
    height: 90px;    
    padding: 5px;
    margin: -400px 2px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div7 {
    text-align: center;
    width: 330px;
    height: 70px;    
    padding: 5px;
    margin: -10px 150px;
  
	} 
.div8 {
    text-align: center;
    width: 500px;
    height: 235px;    
    padding: 5px;
    margin: 40px 80px;
    border: 1px solid red;
    box-sizing: border-box;
   
	}
.div9 {
    text-align: center;
    width: 500px;
    height: 70px;    
    padding: 5px;
    margin: -20px 80px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div10 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: -312px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div11 {
    text-align: center;
    width: 320px;
    height: 130px;    
    padding: 5px;
    margin: 310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div12 {
    text-align: center;
    width: 320px;
    height: 90px;    
    padding: 5px;
    margin: -310px 300px;
    border: 1px solid red;
    box-sizing: border-box;
	} 
.div13 {
    text-align: center;
    width: 20px;
    height: 50px;    
    padding: 5px;
    margin: 320px 240px;
  
	}
.div14 {
    text-align: center;
    width: 500px;
    height: 50px;    
    padding: 5px;
    margin: 50px 50px;
  
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
<a href="http://localhost/PHP/dicchi-nicchi-tutor/Parenthome.php" class="button">Parent Home</button></a>
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
<!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
<a href='Parentlogout.php' class="button"> logout </button></a> <br/><br/>;

</div>


<div class="flex-container">
   

    <div class="flex-item">
     <h1> Tution All Info   </h1> 
    
        <div class="container">

            <!-- div 3 -->
              <div class="div3">
              <h1> Parent Info   </h1> 
              <table class="table table-bordered">  
                          
                         <tr>  
                              <th width="40%"> Parent ID :</th>
                              <th width="20%"><?php echo $parent_id ?></th>
                              
                         </tr>  
                         <tr>  
                              <th width="40%">Name :</th>
                              <th width="20%"><?php echo $parent_name ?></th>
                              
                         </tr>
                 
                        
                         
                    </table> 
               </div>
            <!-- div 3 end -->

             <!-- div 4   -->
             <div class="div4">
             <h1> Student Info   </h1> 
                     
                     <table class="table table-bordered">  

                        <tr>  
                              <th width="40%"> Student Id  :</th>
                              <th width="20%"><?php echo $student_id ?></th>
                              
                         </tr>  
                         <tr>  
                              <th width="40%">Student Name :</th>
                              <th width="20%"><?php echo $student_name ?></th>
                              
                         </tr>

                         <tr>  
                              <th width="40%"> Subject :</th>
                              <th width="20%"><?php echo $subject_name ?></th>
                              
                         </tr>
                         <tr>  
                              <th width="40%"> Class :</th>
                              <th width="20%"><?php echo $class_name ?></th>
                              
                         </tr>
                         <tr>  
                              <th width="40%"> Medium :</th>
                              <th width="20%"><?php echo $medium_name ?></th>
                              
                         </tr>
                         
                       
                        
                   </table>  

              </div>
               <!-- div 4 end   -->

                    
                    
                    
        </div>
            
            
    </div>

    <div class="flex-item">
    
       <div class="container" >
          <!-- div 7 -->
           <div class="div7">
                <h1>Payment Info</h1>
            </div>
           <!-- div 7 end  -->

           <!-- div 8 -->
           <div class="div8">
                 
                <table class="table table-bordered">  
                   
                     <tr>  
                        <th width="40%"> Tution ID  :</th>
                        <th width="20%"><?php echo $tution_id ?></th>
                        
                    </tr>  
                    <tr>  
                        <th width="40%"> Offer Salary (Monthly)  :</th>
                        <th width="20%"><?php echo $Offer_Salary ?></th>
                        
                    </tr>  
                    <tr>  
                        <th width="40%">Security payment (One Time %10). After Completing First Month You will get it back. :</th>
                        <th width="20%">
                            <?php  
                               $tutor_payment_amount = $Offer_Salary*(.10); 
                               echo $tutor_payment_amount;
                            ?>
                        </th>
                        
                    </tr>

                    <tr>  
                        <th width="40%"> After Completing First Month Parent Pay You :</th>
                        <th width="20%">
                            <?php 
                             $due_payment = $Offer_Salary - $tutor_payment_amount;
                              echo $due_payment;
                            ?>
                        </th>
                        
                    </tr>
                
                </table> 

            </div>
           <!-- div 8 end  -->

           <!-- div 9 -->
           <div class="div9">
                 
                <table class="table table-bordered">  
                   
                     <tr>  
                        <th width="40%"> Pay Now :</th>
                        <th width="20%"><?php echo $tutor_payment_amount; ?></th>
                        <th width="20%">
                        <?php   
                            echo  '<form method="post" action="http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_Payment.php" >';
                              
                                echo  '<input type="hidden" name="student_info_id"  value="'; echo $student_id; echo '" />';
                                echo  '<input type="hidden" name="tutor_id"  value="'; echo $tutor_id; echo '" />';
                                echo  '<input type="hidden" name="tutor_tution_info_id"  value="'; echo $tution_info_id; echo '" />';
                                echo  '<input type="hidden" name="tution_id"  value="'; echo $tution_id; echo '" />';
                              
                                echo  '<input type="hidden" name="tutor_payment_amount"  value="'; echo $tutor_payment_amount; echo '" />';
                
                                echo '<button type="submit" name="submit" id="submit" class="btn btn-xs btn-danger"> Pay</button>';
                            echo '</forrm>';  
                       ?>
                       </th>
                        
                    </tr>
                
                </table> 

            </div>
           <!-- div 8 end  -->
        
    
        </div>
        
    </div>

</div>


</body>
</html>

