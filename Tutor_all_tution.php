<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validTutor") || isset($_COOKIE['rm']) ){
     
        $tutor_id = $_SESSION['Tutor_id']; 
	   //all student
                $query = "SELECT * FROM tution_info WHERE tutor_id='$tutor_id'";  
                $result = mysqli_query($conn, $query);
        //all student end

        //subject

        //subject end
			 
    }else {
        header('location: TutorLogin.php?status=login-first');
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
    width: 665px;
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
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutorhome.php" class="button">Tutor Home</button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">All Tution List</h2>

<div class="flex-container">
  
  <div class="flex-item">
      
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

 
   <div class="flex-item">
       <div class="container" style="width:650px;">   
              
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="10%">Tution ID</th>
                               <th width="30%">Subject Name</th>
                               <th width="10%">Class </th>  
                               <th width="10%">Medium </th>  
                               <th width="10%">Salary </th>     
                               <th width="20%">Action</th>
                               <th width="10%">Status</th>  
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["id"]; ?></td>
                               
                               <td>
                                    <?php
                                          $TeacherSubject = $row["TeacherSubject"]; 
                                          $query_Teacher_sub = "SELECT subject_name FROM subject WHERE id='$TeacherSubject'";  
                                          $result_Teacher_sub = mysqli_query($conn, $query_Teacher_sub);
                                          while($row_Teacher_sub = mysqli_fetch_array($result_Teacher_sub))  
                                          {
                                                echo $row_Teacher_sub["subject_name"];
                                          }
                                    ?>
                                </td> 

                                <td>
                                    <?php
                                          $TeacherClass = $row["TeacherClass"]; 
                                          $query_TeacherClass = "SELECT class_name FROM class WHERE id='$TeacherClass'";  
                                          $result_TeacherClass = mysqli_query($conn, $query_TeacherClass);
                                          while($row_TeacherClass = mysqli_fetch_array($result_TeacherClass))  
                                          {
                                                echo $row_TeacherClass["class_name"];
                                          }
                                    ?>
                                </td> 

                                <td>
                                    <?php
                                          $medium = $row["medium"]; 
                                          $query_medium= "SELECT medium_name FROM medium WHERE id='$medium'";  
                                          $result_medium = mysqli_query($conn, $query_medium);
                                          while($row_medium = mysqli_fetch_array($result_medium))  
                                          {
                                                echo $row_medium["medium_name"];
                                          }
                                    ?>
                                </td> 

                                <td><?php echo $row["Tutor_Salary"]; ?></td>  
                               
                               <td>
                                 <a href="http://localhost/PHP/dicchi-nicchi-tutor/Tutor_Tution_info_update.php?tutor_tution_info_id=<?php echo $row["id"]; ?>"  name="edit" class="btn btn-warning btn-xs" title="Edit info"> Edit</a>
                                 <button type="button" name="delete_btn" data-id3="<?php echo $row["id"]; ?>" class="btn btn-xs btn-danger btn_delete">Delete</button> 
                               </td>  

                               <td>
                                 <?php if($row["status"] == 1 ){
                                     echo '<button type="button" name="btn_status" value="'; echo  $row["status"]; echo '" data-id4="'; echo $row["id"]; echo '" class="btn btn-xs btn-success btn_status">active</button>';
                                 }elseif($row["status"] == 0){
                                    echo '<button type="button" name="btn_status" value="'; echo  $row["status"]; echo '" data-id4="'; echo $row["id"]; echo '" class="btn btn-xs btn-danger btn_status">inactive</button>';
                                 } ?>
                               
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

    //delete data
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3"); 
           var current_tr = $(this).closest('tr');
           var action = "delete";
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"Tutor_tution_info_action.php",  
                     method:"POST",  
                     data:{id:id , action:action},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          current_tr.remove(); 
                     }  
                });  
           }  
      });
     //delete end 
     
     //status data
     $(document).on('click', '.btn_status', function(){  
           var tution_id=$(this).data("id4");
           var value=$(this).val();
           var action = "status_change";
           if(confirm("Are you sure you want to change status ?"))  
           {  
                $.ajax({  
                     url:"Tutor_tution_info_action.php",  
                     method:"POST",  
                     data:{tution_id:tution_id , action:action, value:value},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);
                          location.reload();  
                           
                     }  
                });  
           }  
      });
     //status end 

 });  
 </script>

