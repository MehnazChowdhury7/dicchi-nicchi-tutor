<?php

 
    $na = $_REQUEST["Name"];
	$im = $_REQUEST["Image"];
    $ad = $_REQUEST["Address"];
	$ar = $_REQUEST["Area"];
	$di = $_REQUEST["District"];
	$cl = $_REQUEST["Class"];
	$in = $_REQUEST["Ins"];
	$me = $_REQUEST["Medium"];
	$ge = $_REQUEST["Gender"];
	$sa = $_REQUEST["Salary"];
	$st = $_REQUEST["Status"];
	$pa = $_REQUEST["pass"];
	$ph = $_REQUEST["Phone"];
	$id = $_REQUEST["id"];
	
			
	
	
	require("db_rw.php");
    $sql="";
    if(isset($na) && isset($im) && isset($ad) && isset($ar) && isset($di) && isset($ge) && isset($sa) && isset($st) && isset($ph) && isset($id) && strlen($pa)>8 && $na!=null && strlen($ph)==11){
	$sql="INSERT INTO parents_info VALUES ('".$id."','".$na."','".$im."','".$ad."','".$ar."','".$di."','".$ge."','".$sa."','".$st."','".$ph."')";
	header ("Location: http://localhost/PHP/dicchi-nicchi-tutor/dnt.html");
	echo $sql;
	updateDB($sql);
	
	}	
	else
	{
		echo "wrong";
	}
	
	$sql2="";
	if(isset($in) && isset($cl) && isset($me)){
	$sql2="INSERT INTO student_info VALUES ('".$id."','".$in."','".$cl."','".$me."')";
	updateDB($sql2);
	}
	else
	{
		echo "wrong 2";
	}
	$sql3="";
	if(isset($pa)){
	$sql2="INSERT INTO student_info VALUES ('".$id."','".$pa."')";
	updateDB($sql3);
	}
	else
	{
		echo "wrong 3";
	}
?>
