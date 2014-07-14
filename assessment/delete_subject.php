<?php
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	
	$subject_id = $_POST['subject_id'];
	
	$delQuery = "DELETE FROM subjects WHERE subject_id = '$subject_id'";
	
	/*DELETE FROM `assessment`.`subjects` WHERE `subjects`.`id` = 22*/
	
	mysql_query($delQuery) or die ("error occurred");
?>