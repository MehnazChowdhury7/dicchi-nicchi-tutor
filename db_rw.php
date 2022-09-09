<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$mysql_db = 'dicchi_nicchi.com';

$conn = mysqli_connect($mysql_host , $mysql_user , $mysql_password , $mysql_db);

$connect = new PDO("mysql:host=localhost;dbname=dicchi_nicchi.com", "root", "");


// function updateDB($sql){
// 	$conn = mysqli_connect("localhost", "root", "", "dicchi_nicchi.com");
// 	if (!$conn) {
// 		die("Connection failed: " . mysqli_connect_error());
// 	}
// 	if(mysqli_query($conn, $sql)) {
// 		echo "New records updated successfully";
// 	}
// 	else{
// 		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// 	}
// }


// function getJSONFromDB($sql){
// 	$conn = mysqli_connect("localhost", "root", "","dicchi_nicchi.com");
// 	//echo $sql;
// 	$result = mysqli_query($conn, $sql)or die(mysqli_error($$conn));
// 	$arr=array();
// 	//print_r($result);
// 	while($row = mysqli_fetch_assoc($result)) {
// 		$arr[]=$row;
// 	}
// 	return json_encode($arr);
// }

?>