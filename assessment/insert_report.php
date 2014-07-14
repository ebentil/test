<?php
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	
	$student_id = $_POST['student_id'];
	$class_id = $_POST['class_id'];
	$term = $_POST['term'];
	$year = $_POST['year'];
	$total30 = $_POST['total30'];
	$total70 = $_POST['total70'];
	$total100 = $_POST['total100'];
	$overall_position = $_POST['overall_class'];
	$att1Val = $_POST['att1Val'];
	$att2Val = $_POST['att2Val'];
	$ntbVal = $_POST['ntbVal'];
	$conductVal = $_POST['conductVal'];
	$attitudeVal = $_POST['attitudeVal'];
	$interestVal = $_POST['interestVal'];
	$fmrVal = $_POST['fmrVal'];
	$sfacVal = $_POST['sfacVal'];
	$smrVal = $_POST['smrVal'];
	
	
	$query1 = mysql_query("SELECT * FROM reports WHERE student_id = '$student_id' AND class_id = '$class_id' AND term = '$term' AND year = '$year'") or die(mysql_error());
	if(mysql_num_rows($query1) == 0) { 
	$query = "INSERT INTO reports (student_id, class_id, term, year, total30, total70, total100, overall_position, att1, att2, next_term_begins, conduct, interest, form_master_remarks, sch_fees, sch_mgr_remarks) VALUES ('$student_id' , '$class_id',  '$term', '$year', '$total30', '$total70', '$total100' , '$overall_position', '$att1Val', '$att2Val', '$ntbVal', '$conductVal',  '$interestVal', '$fmrVal', '$sfacVal', '$smrVal')"; 
		mysql_query($query) or die(mysql_error());
	} else {
		$query = "UPDATE reports SET total30 = '$total30', total70 = '$total70', total100 = '$total100', overall_position = '$overall_position', att1 = '$att1Val', att2 = '$att2Val', next_term_begins = '$ntbVal', conduct = '$conductVal', attitude = '$attitudeVal', interest = '$interestVal', form_master_remarks = '$fmrVal', sch_fees = '$sfacVal', sch_mgr_remarks = '$smrVal' WHERE student_id = '$student_id' AND class_id = '$class_id' AND term = '$term' AND year = '$year'"; 
		mysql_query($query) or  die(mysql_error());
	}
	
	
?>