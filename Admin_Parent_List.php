<?php
	require('db_rw.php');
    session_start();

	if( ($_SESSION['abc'] == "validAdmin") || isset($_COOKIE['rm']) ){
     
        $admin_id = $_SESSION['admin_id']; 
	   //all student
                $query = "SELECT * FROM parentregistration ";  
                $result = mysqli_query($conn, $query);
        //all student end
			 
    }else {
        header('location: ParentLogin.php?status=login-first');
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
    <a href="http://localhost/PHP/dicchi-nicchi-tutor/Adminhome.php" class="button">Admin Home</button></a>
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/TutorLogIn.html" class="button">Search tution</button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/Contact.html" class="button">Contact </button></a> -->
    <!-- <a href="http://localhost/PHP/dicchi-nicchi-tutor/AdminLogin.php" class="button">Admin</button></a> -->
</div>

<div>

<h2 class="h2">All Student List</h2>

<div class="flex-container">
  
  <div class="flex-item">
      
        <div id="dataModal" class="modal fade">  
            <div class="modal-dialog">  
                <div class="modal-content">  
                        
                        <div class="modal-header">  
                            <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            <h4 class="modal-title">Student Details</h4>  
                        </div>  
                        
                        <div class="modal-body" id="parent_detail">  
                        </div>  
                        
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </div>
                        
                </div>  
            </div>  
        </div>
    
  </div>

 
   <div class="flex-item">
       <div class="container" style="width:650px;">   
              
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="10%">Tutor ID</th>
                               <th width="10%">Tutor Name</th>   
                               <th width="20%">Action</th>
                               <th width="10%">Status</th>
                               <th width="20%">verify</th>  
                          </tr>  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["id"]; ?></td>
                               <td><?php echo $row["username"]; ?></td>   
                               <td>
                                 <input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" />
                                 <a href="http://localhost/PHP/dicchi-nicchi-tutor/Parent_student_update.php?std_id=<?php echo $row["id"]; ?>"  name="edit" class="btn btn-warning btn-xs" title="Edit User"> Edit</a>
                                 <button type="button" name="delete_btn" data-id3="<?php echo $row["id"]; ?>" class="btn btn-xs btn-danger btn_delete">Delete</button> 
                               </td>  
                               <td>
                                 <?php if($row["is_admin_approve"] == 1){
                                    if($row["status"] == 1 ){
                                        echo '<button type="button" name="btn_status" value="'; echo  $row["status"]; echo '" data-id4="'; echo $row["id"]; echo '" class="btn btn-xs btn-success btn_status">active</button>';
                                    }elseif($row["status"] == 0){
                                        echo '<button type="button" name="btn_status" value="'; echo  $row["status"]; echo '" data-id4="'; echo $row["id"]; echo '" class="btn btn-xs btn-danger btn_status">inactive</button>';
                                    } 
                                }
                                 ?>
                               </td>
                               <td>
                                 <?php  if($row["is_admin_approve"] == 0 ){
                                     
                                    echo '<input type="hidden" name="admin_id" value="'; echo  $admin_id;  echo '" data-id7="'; echo $admin_id; echo '" class="btn btn-xs btn-success admin_id">';
                                    echo '<button type="button" name="btn_is_admin_approve" value="account_approve';  echo '" data-id5="'; echo $row["id"]; echo '" class="btn btn-xs btn-success btn_verify">Approve</button>';
                                    echo '<button type="button" name="btn_is_admin_approve" value="account_unapproved'; echo '" data-id6="'; echo $row["id"]; echo '" class="btn btn-xs btn-danger btn_verify">Unapproved</button>';
                                }elseif($row["is_admin_approve"] == 1 ){
                                     
                                    echo '<input type="button" name="admin_id" value="SUPERADMIN';  echo '" class="btn btn-xs btn-info ">';
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
    //view
      $('.view_data').click(function(){  
           var parent_id = $(this).attr("id");  
           var action = "admin_view_parent";
           $.ajax({  
                url:"Admin_account_verify.php",  
                method:"post",  
                data:{parent_id:parent_id , action:action},  
                success:function(data){  
                     $('#parent_detail').html(data);  
                     $('#dataModal').modal("show");  
                }  
           });  
      }); 
    //view end 

    //delete data
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id3");  
           var current_tr = $(this).closest('tr');
           var action = "admin_parent_delete";
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"Admin_account_verify.php",  
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
           var parent_id=$(this).data("id4");
           console.log(parent_id);
           var value=$(this).val();
           var action = "admin_parent_status_change";
           if(confirm("Are you sure you want to change status ?"))  
           {  
                $.ajax({  
                     url:"Admin_account_verify.php",  
                     method:"POST",  
                     data:{parent_id:parent_id , action:action, value:value},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);
                          location.reload();  
                           
                     }  
                });  
           }  
      });
     //status end 

       //approve 
       $(document).on('click', '.btn_verify', function(){  
           
           var value=$(this).val();

           if(value == "account_approve"){
            var parent_id=$(this).data("id5");
            var admin_id=$('.admin_id').val();
               
            var action = "Parent Account Approve";
           }else if(value == "account_unapproved"){
            var parent_id=$(this).data("id6");
            var admin_id=$('.admin_id').val();
            
            var action = "Parent Account Unapproved";
           }
        
           if(confirm("Are you sure you want to this ?"))  
           {  
                $.ajax({  
                     url:"Admin_account_verify.php",  
                     method:"POST",  
                     data:{parent_id:parent_id , admin_id:admin_id , action:action},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);
                          location.reload();  
                           
                     }  
                });  
           }  
      });
     //approve end

 });  
 </script>

