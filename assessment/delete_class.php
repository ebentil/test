<?php
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	
	$class_id = $_POST['class_id'];
	
	$delQuery = "DELETE FROM classes WHERE class_id = '$class_id'";
	
	/*DELETE FROM `assessment`.`subjects` WHERE `subjects`.`id` = 22*/
	
	mysql_query($delQuery) or die ("error occurred");
?>