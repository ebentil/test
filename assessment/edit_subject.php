<?php
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	
	$subject_id = $_POST['subject_id'];
	$subject_name = ucwords($_POST['subject_name']);
	
	$editQuery = "UPDATE subjects SET subject_name = '$subject_name' WHERE subject_id = '$subject_id'";
		
	mysql_query($editQuery) or die ("error occurred");
?>