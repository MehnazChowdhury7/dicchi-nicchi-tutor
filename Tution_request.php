<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validAdmin") || isset($_COOKIE['rm']) ){
     
       if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];

        $query = "SELECT * FROM tution WHERE (status='1' OR status='7' OR status='3' OR status='5' OR status='2' OR status='4' OR status='6' OR status='11') ";  
        $result = mysqli_query($conn, $query);

       } 

			 
    }else {
        header('location: AdminLogin.php?status=login-first');
    }
	
	if(isset($_GET['status']))
		{
			$status = $_GET['status'];
            echo $status;
		}

//mysqli_close($conn);
?>

<html>
<head>
      <title>Search a tutor</title>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 

	  
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
    height: 350px;
    background-color: grey;
}

.flex-item {
    text-align: center;
    background-color: lightgrey;
    width: 65px;
    height: 350px;
    margin: 2px;
}
.flex-item-2 {
    text-align: center;
    background-color: lightgrey;
    width: 1320px;
    height: 350px;
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
    <?php if(isset($tutor_id)){
       echo '<a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>';
    }elseif (isset($admin_id)) {
        echo '<a href="http://localhost/PHP/dicchi-nicchi-tutor/Adminhome.php" class="button">Admin Home</button></a>';
    } ?>
</div>

<div>

<h2 class="h2">All Tution List</h2>

<div class="flex-container">
  
  <div class="flex-item-1">
      
        <!-- <div id="dataModal" class="modal fade">  
            <div class="modal-dialog">  
                <div class="modal-content">  
                        
                        <div class="modal-header">  
                            <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            <h4 class="modal-title">Tution Details</h4>  
                        </div>  
                        
                        <div class="modal-body" id="tution_detail">  
                        </div>  
                        
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div>
                        
                </div>  
            </div>  
        </div> -->
    
  </div>

 
   <div class="flex-item-2">
       <div class="container" style="width:850px;">   
              
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th >Tution ID</th>
                               <th >Tution Info ID</th>
                               <?php if(isset( $admin_id)){
                                   
                                 echo '<th >Tutor Name</th>';

                               } ?>
                               <th >Studnt Name </th>  
                               <th >Parent Name </th>
                               <th >Class </th>  
                               <th >Subject </th>  
                               <th >Medium </th>     
                               <th >Status</th>  
                               <th style="text-align:center" width="100%">action</th>
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
            
                          ?>  
                          <tr>  
                               <td><?php echo $row["id"]; ?></td>
                               
                               <!-- Tution Info -->
                               <?php
                                        $tution_info_id = $row["tution_info_id"];
                                       
                                        $query_tution_info = "SELECT * FROM tution_info WHERE id='$tution_info_id'";  
                                        $result_tution_info = mysqli_query($conn, $query_tution_info);
                                        while($row_tution_info = mysqli_fetch_array($result_tution_info))  
                                        {
                                                    $Tution_info_class =     $row_tution_info["TeacherClass"];
                                                    $Tution_info_subject =     $row_tution_info["TeacherSubject"];
                                                    $Tution_info_medium =     $row_tution_info["medium"];
                                                    $Tution_info_salary =     $row_tution_info["Tutor_Salary"];
                                        }
            
                                ?>
                                <!-- Tution Info end -->

                                <!-- tution info id -->
                                <td><?php echo $tution_info_id; ?></td>
                                <!-- tution info id end -->

                                <!-- tutor name   -->
                                <?php
                                  if(isset($admin_id)){
                                    echo  '<td>';
                                     
                                       $teacher_id = $row["teacher_id"];
                                       $teacher_name = "SELECT * FROM tutorregistration WHERE id='$teacher_id'";
                                       $result_teacher_name = mysqli_query($conn, $teacher_name);
                                        while($row_teacher_name = mysqli_fetch_array($result_teacher_name))  
                                        {
                                                    $teacher_name =     $row_teacher_name["username"];
                                        }
                                       echo $teacher_name;
                                    
                                echo '</td>';
                                  }
                                
                                ?>
                                <!-- tutor name end -->
                                
                                <!-- student info -->
                                <?php
                                        $student_info_id = $row["student_id"];
                                       
                                        $query_student_info = "SELECT * FROM student_info WHERE id='$student_info_id'";  
                                        $result_student_info = mysqli_query($conn, $query_student_info);
                                        while($row_student_info = mysqli_fetch_array($result_student_info))  
                                        {
                                                    $student_name =     $row_student_info["studentname"];
                                                
                                        }
            
                                ?>
                                <!-- student info end -->

                                <!-- student name -->
                                <td><?php echo $student_name; ?></td>
                                <!-- student name end -->

                                <!-- parent info -->
                                    <?php
                                        $parent_info_id = $row["parent_id"];
                                       
                                        $query_parent_info = "SELECT * FROM parentregistration WHERE id='$parent_info_id'";  
                                        $result_parent_info = mysqli_query($conn, $query_parent_info);
                                        while($row_parent_info = mysqli_fetch_array($result_parent_info))  
                                        {
                                                    $parent_name =     $row_parent_info["username"];
                                                
                                        }
            
                                ?>
                                <!-- parent info end -->

                                <!-- parent name -->
                                <td><?php echo $parent_name; ?></td>
                                <!-- preent name end -->
                               
                               
                            <!-- class -->
                               <td>
                                    <?php
                                           
                                          $query_Class = "SELECT class_name FROM class WHERE id='$Tution_info_class'";  
                                          $result_Class = mysqli_query($conn, $query_Class);
                                          while($row_Class = mysqli_fetch_array($result_Class))  
                                          {
                                                echo $row_Class["class_name"];
                                          }
                                    ?>
                                </td> 
                                <!-- class end -->
                               
                               <!-- subject -->
                               <td>
                                    <?php
                                          
                                          $query_sub = "SELECT subject_name FROM subject WHERE id='$Tution_info_subject'";  
                                          $result_sub = mysqli_query($conn, $query_sub);
                                          while($row_sub = mysqli_fetch_array($result_sub))  
                                          {
                                                echo $row_sub["subject_name"];
                                          }
                                    ?>
                                </td>
                                <!-- subject end  -->

                                <!-- medium -->
                                <td>
                                    <?php 
                                          $query_medium= "SELECT medium_name FROM medium WHERE id='$Tution_info_medium'";  
                                          $result_medium = mysqli_query($conn, $query_medium);
                                          while($row_medium = mysqli_fetch_array($result_medium))  
                                          {
                                                echo $row_medium["medium_name"];
                                          }
                                    ?>
                                </td> 
                                <!-- medium end -->
                                
                                <!-- status -->
                                <td><?php 
                                
                                $tution_id = $row["id"];

                                //parent payment
                                $query_parent_tution_payment = "SELECT * FROM parent_tution_payment WHERE tution_id='$tution_id'"; 
                                $result_parent_tution_payment = mysqli_query($conn, $query_parent_tution_payment);
                            
                                while($row_parent_tution_payment = mysqli_fetch_array($result_parent_tution_payment)) {
                                    $parent_tution_payment_id =  $row_parent_tution_payment["tution_id"];
                                    $parent_tution_payment_is_admin_approve =  $row_parent_tution_payment["is_admin_approve"];
                                    }
                                //parent payment end 
                                
                                //tutor payment
                                $query_tutor_tution_payment = "SELECT * FROM tutor_tution_payment WHERE tution_id='$tution_id'"; 
                                $result_tutor_tution_payment = mysqli_query($conn, $query_tutor_tution_payment);
                            
                                while($row_tutor_tution_payment = mysqli_fetch_array($result_tutor_tution_payment)) {
                                    $tutor_tution_payment_id =  $row_tutor_tution_payment["tution_id"];
                                    $tutor_tution_payment_is_admin_approve =  $row_tutor_tution_payment["is_admin_approve"];
                                    }
                                //tutor payment end

                                if(isset($admin_id)){
                                  
                                    if($row["status"] == 1){
                                        echo '<input type="button" value="Parent requested for tutor" class="btn btn-xs btn-warning "> ';  
                                    }elseif ($row["status"] == 2) {
                                        echo '<input type="button" value="tutor requested for tution" class="btn btn-xs btn-warning "> '; 
                                    }elseif ($row["status"] == 7) {
                                        echo '<input type="button" value="waiting for tutor response" class="btn btn-xs btn-info "> '; 
                                    }elseif ($row["status"] == 3 && $row["parent_is_pay"] == 0) {
                                        echo '<input type="button" value="tutor Confirmed for tution Request" class="btn btn-xs btn-info "> ';
                                        echo '<input type="button" value="waiting For Parent Payment" class="btn btn-xs btn-warning "> '; 
                                    }elseif ($row["status"] == 4 && $row["tutor_is_pay"] == 0) {
                                        echo '<input type="button" value="Parent Confirmed for tution Request" class="btn btn-xs btn-info "> ';
                                        echo '<input type="button" value="waiting For Tutor Payment" class="btn btn-xs btn-warning "> '; 
                                    }elseif ($row["status"] == 4 && $row["tutor_is_pay"] == 1 && $tutor_tution_payment_is_admin_approve == 0) {
                                        echo '<input type="button" value="Tutor paid" class="btn btn-xs btn-info "> ';
                                        echo '<input type="button" value="waiting For account payment approve" class="btn btn-xs btn-warning "> '; 
                                    }elseif ($row["status"] == 4 && $row["tutor_is_pay"] == 1 && $tutor_tution_payment_is_admin_approve == 1) {
                                        echo '<input type="button" value="Tutor paid" class="btn btn-xs btn-info "> ';
                                        echo '<input type="button" value="Admin Approved. please confirm this." class="btn btn-xs btn-warning "> ';  
                                    }elseif ($row["status"] == 3 && $row["parent_is_pay"] == 1 && $parent_tution_payment_is_admin_approve == 0) {
                                        echo '<input type="button" value="parent paid" class="btn btn-xs btn-info "> ';
                                        echo '<input type="button" value="waiting For admin payment approve" class="btn btn-xs btn-warning "> '; 
                                    }elseif ($row["status"] == 3 && $row["parent_is_pay"] == 1 && $parent_tution_payment_is_admin_approve == 1) {
                                        echo '<input type="button" value="parent paid" class="btn btn-xs btn-info "> ';
                                        echo '<input type="button" value="Admin Approved. please confirm this." class="btn btn-xs btn-warning "> '; 
                                    }elseif ($row["status"] == 5) {
                                        echo '<input type="button" value="tutor rejected for tution Request" class="btn btn-xs btn-info "> '; 
                                    }elseif ($row["status"] == 6) {
                                        echo '<input type="button" value="parent rejected for tution Request" class="btn btn-xs btn-info "> '; 
                                    }elseif ($row["status"] == 11) {
                                        echo '<input type="button" value="waiting for parent response" class="btn btn-xs btn-info "> '; 
                                    }
                                  
                                 }
                                  
                                 ?></td>  
                                <!-- status end -->
                               
                               <td>
                                 <input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /> 
                                 <?php 
                                 if(isset($admin_id)){
                                  echo '<input type="hidden" data-id6="'.$admin_id.'" value="'.$admin_id.'" class=" admin_id"> ';
                                    if($row["status"] == 1){
                                        echo '<input type="button" name="approved_btn" data-id4="'.$row["id"].'" value="approved" class="btn btn-xs btn-warning btn_action"> '; 
                                        echo '<input type="button" name="unapproved_btn" data-id5="'.$row["id"].'" value="unapproved" class="btn btn-xs btn-danger btn_action"> '; 
                                    }elseif($row["status"] == 2){
                                        echo '<input type="button" name="Tutor_req_approved_btn" data-id9="'.$row["id"].'" value="Tutor request approved" class="btn btn-xs btn-warning btn_action"> '; 
                                        echo '<input type="button" name="Tutor_req_unapproved_btn" data-id10="'.$row["id"].'" value="Tutor request unapproved" class="btn btn-xs btn-danger btn_action"> '; 
                                    }elseif($row["status"] == 3 && $row["parent_is_pay"] == 1 && $parent_tution_payment_is_admin_approve == 1){
                                        echo '<input type="button" name="confirm_btn" data-id8="'.$row["id"].'" value="confirm" class="btn btn-xs btn-warning btn_action"> '; 
                                        echo '<input type="button" name="delete_btn" data-id8="'.$row["id"].'" value="delete" class="btn btn-xs btn-danger btn_action"> '; 
                                    }elseif($row["status"] == 4 && $row["tutor_is_pay"] == 1 && $tutor_tution_payment_is_admin_approve == 1){
                                        echo '<input type="button" name="confirm_btn" data-id8="'.$row["id"].'" value="confirm" class="btn btn-xs btn-warning btn_action"> '; 
                                        echo '<input type="button" name="delete_btn" data-id8="'.$row["id"].'" value="delete" class="btn btn-xs btn-danger btn_action"> '; 
                                    }elseif($row["status"] == 5 && $row["status"] == 6 ){
                                        echo '<input type="button" name="delete_btn" data-id7="'.$row["id"].'" value="delete" class="btn btn-xs btn-danger btn_action">';
                                    }
                                  
                                 }
                                  
                                 ?>
                               </td>  
                          </tr>  
                          <?php  
                          }  
                       
                          ?>  
                     </table>  
                </div>  

           </div> 
   </div>

</div>

  
    
</div>
</body>
</html>

<script>  
 $(document).ready(function(){ 

    //ajax data
      $(document).on('click', '.btn_action', function(){
           var action_value = $(this).val();
           var current_tr = $(this).closest('tr');
           
           
           if(action_value == "reject" ){
               var tution_id=$(this).data("id3");
           
              var action = "Reject";

           }else if(action_value == "accept"){

                var tution_id=$(this).data("id2");
            
                var action = "accept";
           }else if(action_value == "approved"){
                var tution_id=$(this).data("id4");

                var action = "approved";
           }else if(action_value == "unapproved"){
               
                var tution_id=$(this).data("id5");

                var action = "unapproved";
           }else if(action_value == "Tutor request approved"){
                var tution_id=$(this).data("id9");
                console.log(tution_id);

                var action = "Tutor request approved";
           }else if(action_value == "Tutor request unapproved"){
               
                var tution_id=$(this).data("id10");

                var action = "Tutor request unapproved";
           }else if(action_value == "confirm"){
               
               var tution_id=$(this).data("id8");
               var admin_id = $(".admin_id").data("id6");

               var action = "confirm";
          }else if(action_value == "delete"){
               
               var tution_id=$(this).data("id7");
               var admin_id = $(".admin_id").data("id6");

               var action = "tution_delete";
          }

           if(confirm("Are you sure you want to " + action +  " this tution?"))  
           {  
                $.ajax({  
                     url:"Tution_action.php",  
                     method:"POST",  
                     data:{tution_id:tution_id , action:action , admin_id:admin_id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          current_tr.remove(); 
                          if(data == "Tution approved Successfully" || data == "Tution accepted Successfully"){
                              location.reload();
                          }
                     }  
                });  
           }  
      });
     //ajax end  

 });  
 </script>

