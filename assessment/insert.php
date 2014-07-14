<?php
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");

	$student_id = $_POST['student_id'];
	$class_id = $_POST['class_id'];
	$subject_id = $_POST['subject_id'];
	$term = $_POST['term'];
	$year = $_POST['year'];
	$ex1 = $_POST['ex1'];
	$ex2 = $_POST['ex2'];
	$ex3 = $_POST['ex3'];
	$ex4 = $_POST['ex4'];
	$ex_tot = $_POST['ex_tot'];
	$t1 = $_POST['t1'];
	$t2 = $_POST['t2'];
	$t3 = $_POST['t3'];
	$t_tot = $_POST['t_tot'];
	$hw1 = $_POST['hw1'];
	$hw2 = $_POST['hw2'];
	$hw3 = $_POST['hw3'];
	$hw4 = $_POST['hw4'];
	$hw_tot = $_POST['hw_tot'];
	$c_subtot = $_POST['c_subtot'];
	$c_subtot30 = $_POST['c_subtot30'];
	$exam100 = $_POST['exam100'];
	$exam70 = $_POST['exam70'];
	$overall30_70 = $_POST['overall30_70'];
	$grade = $_POST['grade'];
	$position = $_POST['position'];
	$remarks = $_POST['remarks'];
	
	$query1 = mysql_query("SELECT * FROM sheets WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id' AND term = '$term' AND year = '$year'") or die(mysql_error());
	if(mysql_num_rows($query1) == 0) { 
	$query = "INSERT INTO sheets (class_id, subject_id, student_id, term, year, ex1, ex2, ex3, ex4, ex_tot, t1, t2, t3, t_tot, hw1, hw2, hw3, hw4, hw_tot, c_subtot, c_subtot30, exam100, exam70, overall30_70, grade, position, remarks) VALUES ('$class_id', '$subject_id', '$student_id', '$term', '$year', '$ex1', '$ex2', '$ex3', '$ex4', '$ex_tot', '$t1', '$t2', '$t3', '$t_tot', '$hw1', '$hw2', '$hw3', '$hw4', '$hw_tot', '$c_subtot', '$c_subtot30', '$exam100', '$exam70', '$overall30_70', '$grade', '$position', '$remarks')"; 
		mysql_query($query) or die(mysql_error());
	} else {
		$query = "UPDATE sheets SET ex1 = '$ex1', ex2 = '$ex2', ex3 = '$ex3', ex4 = '$ex4', ex_tot = '$ex_tot', t1 = '$t1', t2 = '$t2', t3 = '$t3', t_tot = '$t_tot', hw1 = '$hw1', hw2 = '$hw2', hw3 = '$hw3', hw4 = '$hw4', hw_tot = '$hw_tot', c_subtot = '$c_subtot', c_subtot30 = '$c_subtot30', exam100 = '$exam100', exam70 = '$exam70', overall30_70 = '$overall30_70', grade = '$grade', position = '$position', remarks = '$remarks' WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id' AND term = '$term' AND year = '$year'"; 
		mysql_query($query) or  die(mysql_error());
	}
	//echo "OK";
 ?>