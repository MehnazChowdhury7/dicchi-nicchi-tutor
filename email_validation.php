<?php 
require('db_rw.php');


if($_POST["method"] == "parent_email" ){
    $parent_eamil = $_POST["email"];

    $sql ="SELECT * FROM parentregistration WHERE email = '$parent_eamil'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        echo '<span class="text-danger">This Email is already available</span>';
    }
        
}
if ($_POST["method"] == "tutor_email") {
    $tutor_eamil = $_POST["tutor_email"];

    $sql ="SELECT * FROM tutorregistration WHERE email = '$tutor_eamil'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0){
        echo '<span class="text-danger">This Email is already available</span>';
    }

  
}

?>