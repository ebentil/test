<?php 
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	
	$sel_class = $_GET['class'];
	$sel_subject = $_GET['subj'];
	$sel_term = $_GET['term'];
	$sel_year = $_GET['year'];

	$sql = "SELECT * FROM students WHERE class_id ='$sel_class' AND gender = 'male'";
	$studQuery = mysql_query($sql);

	$sql2 = "SELECT * FROM students WHERE class_id ='$sel_class' AND gender = 'female'";
	$studQuery2 = mysql_query($sql2);	
?>
	
<table border="1" align="center" cellspacing="0" width="">
  <?php 
  	 echo "<tr class='tableHead'>";
	 echo "<td width='200' rowspan='2' border='0' >NAME OF PUPIL</td>
    <td height='48' colspan='4'>CLASS EXERCISES</td>
    <td width='30'>SUB TOT<br>(40)</td>
    <td colspan='3'>CLASS TEST</td>
    <td width='30'>SUB TOT<br>(40)</td>
    <td colspan='4'>PROJECT/<br>HOMEWORK</td>
    <td width='30'>SUB TOT<br>(40)</td>
    <td width='50'>SUB TOTAL SCORE<br>(100)</td>
    <td width='50'>30%</td>
    <td width='50'>END OF TERM EXAM<br>(100)</td>
    <td width='50'>EXAM 70%</td>
    <td width='50'>OVERALL TOTAL</td>
	<td width='50'>GRADE</td>
    <td width='50'>POSITION</td>
    <td width='50'>REMARKS</td> 
	</tr>
    <tr class='marks'>
	<td width='30'>10</td>
    <td width='30'>10</td>
    <td width='30'>10</td>
    <td width='30'>10</td>
    <td width='40' height='3'>40</td>
    <td width='30' height='3'>20</td>
    <td width='30' height='3'>10</td>
    <td width='30' height='3'>10</td>
    <td width='40' height='3'>40</td>
    <td width='30' height='3'>5</td>
    <td width='30' height='3'>5</td>
    <td width='30' height='3'>5</td>
    <td width='30' height='3'>5</td>
    <td width='40' height='3'>20</td>
    <td width='60' height='3'>&nbsp;</td>
    <td width='60' height='3'>&nbsp;</td>
    <td width='60' height='3'>100</td>
    <td width='60' height='3'>&nbsp;</td>
    <td width='60' height='3'>30% + 70%</td>
    <td width='60' height='3'>&nbsp;</td>
	<td width='60' height='3'>&nbsp;</td>
    <td width='50' height='3'>&nbsp;</td> ";
	 echo "</tr>";
	
   $i=0; 
   while($studentObject = mysql_fetch_array($studQuery)) {
	   $i = $i +1;
	 echo "<tr onmouseover=\"this.bgColor='#FFF8E2'\" onmouseout=\"this.bgColor='#ffffff'\">"; 
	 echo "<input type='hidden' id='student_id".$i."' value='".$studentObject['student_id']."'>
    <td width='200' height='30'><input name='name' type='text' disabled = 'disabled' id='name' class='nameBox' onchange='check_empty_name()' value='".$studentObject['lname'] ." ". $studentObject['fname']."' ></td>";
	$studID = $studentObject['student_id'];
	
	$sheetQ = mysql_query("SELECT * FROM sheets WHERE student_id = '$studID' AND class_id = '$sel_class' AND subject_id = '$sel_subject' AND term = '$sel_term' AND year = '$sel_year'");
	$sheetObject = mysql_fetch_array($sheetQ);
	
	echo   "<td width='30' height='30' class='smallCell'>
	<input type='hidden' id='class_id".$i."' value='".$sel_class."'>
	<input type='hidden' id='subject_id".$i."' value='".$sel_subject."'>
	<input type='hidden' id='term".$i."' value='".$sel_term."'>
	<input type='hidden' id='year".$i."' value='".$sel_year."'>
	<input name='ex1' value='".$sheetObject['ex1']."' type='text' maxlength='4' id='ex1".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex1".$i."\", \"10\")' ></td>
    <td width='30' height='30' class='smallCell'><input name='ex2' value='".$sheetObject['ex2']."' type='text' maxlength='4' id='ex2".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex2".$i."\", \"10\")' ></td>
    <td width='30' height='30' class='smallCell'><input name='ex3' value='".$sheetObject['ex3']."' type='text' maxlength='4' id='ex3".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex3".$i."\", \"10\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='ex4' value='".$sheetObject['ex4']."' type='text' maxlength='4' id='ex4".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex4".$i."\", \"10\")'  ></td>
    <td width='40' height='30' class='subCell'><input name='ex_tot' value='".$sheetObject['ex_tot']."' type='text' disabled = 'disabled' id=\"ex_tot".$i."\" class='subBox'  ></td>
	
    <td width='30' height='30' class='smallCell'><input name='t1' value='".$sheetObject['t1']."' type='text' maxlength='4' id='t1".$i."' class='smallBox' onkeyup='check_integer_Test(\"t1".$i."\", \"20\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='t2' value='".$sheetObject['t2']."' type='text' maxlength='4' id='t2".$i."' class='smallBox' onkeyup='check_integer_Test(\"t2".$i."\", \"10\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='t3' value='".$sheetObject['t3']."' type='text' maxlength='4' id='t3".$i."' class='smallBox' onkeyup='check_integer_Test(\"t3".$i."\", \"10\")'  ></td>
    <td width='40' height='30' ><input name='t_tot' value='".$sheetObject['t_tot']."' type='text' disabled = 'disabled' id=\"t_tot".$i."\" class='subBox' onchange='check_integer()'  ></td></td>
	
    <td width='30' height='30' class='smallCell'><input name='hw1' value='".$sheetObject['hw1']."' type='text' maxlength='3' id='hw1".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw1".$i."\", \"5\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='hw2' value='".$sheetObject['hw2']."' type='text' maxlength='3' id='hw2".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw2".$i."\", \"5\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='hw3' value='".$sheetObject['hw3']."' type='text' maxlength='3' id='hw3".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw3".$i."\", \"5\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='hw4' value='".$sheetObject['hw4']."' type='text' maxlength='3' id='hw4".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw4".$i."\", \"5\")'  ></td>
    <td width='40' height='30' ><input name='hw_tot' value='".$sheetObject['hw_tot']."' type='text' disabled = 'disabled' id=\"hw_tot".$i."\" class='subBox'  ></td></td>
	
    <td width='60' height='30' ><input name='c_subtot' value='".$sheetObject['c_subtot']."' type='text' disabled = 'disabled' id=\"c_subtot".$i."\" class='totBox'  ></td></td>
    <td width='60' height='30' ><input name='c_subtot30' value='".$sheetObject['c_subtot30']."' type='text' disabled = 'disabled' id=\"c_subtot30".$i."\" class='totBox' onchange='add_overall(\"".$i."\")' ></td>
    <td width='60' height='30' class='smallCell'><input name='exams100' value='".$sheetObject['exam100']."' type='text'maxlength='5' id=\"exam100".$i."\" class='examBox' onkeyup='calcexam70(\"".$i."\", \"100\")'  ></td>
    <td width='60' height='30'><input name='exams70' value='".$sheetObject['exam70']."' type='text' disabled = 'disabled' id=\"exam70".$i."\" class='totBox'  ></td>
    <td width='60' height='30'><input name='overall30_70' value='".$sheetObject['overall30_70']."' type='text' disabled = 'disabled' id=\"overall30_70".$i."\" class='totBox' ></td>
	<td width='60' height='30'><input name='grade' value='".$sheetObject['grade']."' type='text' disabled = 'disabled' id=\"grade".$i."\" class='totBox' ></td>
    <td width='60' height='30'><input name='position' value='".$sheetObject['position']."' type='text' disabled = 'disabled' id=\"position".$i."\" class='totBox' ></td>
    <td width='200' height='30'><input name='remarks' value='".$sheetObject['remarks']."' type='text' disabled = 'disabled' id=\"remarks".$i."\" class='remarksBox' ></td> 
	 ";
	}
	 echo "</tr>";
	 
	 
	 echo "<tr><td colspan='23' style='background-color:#EFEFEF; height:6px;'></td></tr>";
	 
	 //GIRLS
	 while($studentObject = mysql_fetch_array($studQuery2)) {
	   $i = $i +1;
	 echo "<tr onmouseover=\"this.bgColor='#FFF8E2'\" onmouseout=\"this.bgColor='#ffffff'\">"; 
	 echo "<input type='hidden' id='student_id".$i."' value='".$studentObject['student_id']."'>
    <td width='200' height='30'><input name='name' type='text' disabled = 'disabled' id='name' class='nameBox' onchange='check_empty_name()' value='".$studentObject['lname'] ." ". $studentObject['fname']."' ></td>";
	$studID = $studentObject['student_id'];
	
	$sheetQ = mysql_query("SELECT * FROM sheets WHERE student_id = '$studID' AND class_id = '$sel_class' AND subject_id = '$sel_subject' AND term = '$sel_term' AND year = '$sel_year'");
	$sheetObject = mysql_fetch_array($sheetQ);
	
	echo   "<td width='30' height='30' class='smallCell'>
	<input type='hidden' id='class_id".$i."' value='".$sel_class."'>
	<input type='hidden' id='subject_id".$i."' value='".$sel_subject."'>
	<input type='hidden' id='term".$i."' value='".$sel_term."'>
	<input type='hidden' id='year".$i."' value='".$sel_year."'>
	<input name='ex1' value='".$sheetObject['ex1']."' type='text' maxlength='4' id='ex1".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex1".$i."\", \"10\")' ></td>
    <td width='30' height='30' class='smallCell'><input name='ex2' value='".$sheetObject['ex2']."' type='text' maxlength='4' id='ex2".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex2".$i."\", \"10\")' ></td>
    <td width='30' height='30' class='smallCell'><input name='ex3' value='".$sheetObject['ex3']."' type='text' maxlength='4' id='ex3".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex3".$i."\", \"10\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='ex4' value='".$sheetObject['ex4']."' type='text' maxlength='4' id='ex4".$i."' class='smallBox' onkeyup='javascript:check_integer_Ex(\"ex4".$i."\", \"10\")'  ></td>
    <td width='40' height='30' class='subCell'><input name='ex_tot' value='".$sheetObject['ex_tot']."' type='text' disabled = 'disabled' id=\"ex_tot".$i."\" class='subBox'  ></td>
	
    <td width='30' height='30' class='smallCell'><input name='t1' value='".$sheetObject['t1']."' type='text' maxlength='4' id='t1".$i."' class='smallBox' onkeyup='check_integer_Test(\"t1".$i."\", \"20\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='t2' value='".$sheetObject['t2']."' type='text' maxlength='4' id='t2".$i."' class='smallBox' onkeyup='check_integer_Test(\"t2".$i."\", \"10\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='t3' value='".$sheetObject['t3']."' type='text' maxlength='4' id='t3".$i."' class='smallBox' onkeyup='check_integer_Test(\"t3".$i."\", \"10\")'  ></td>
    <td width='40' height='30' ><input name='t_tot' value='".$sheetObject['t_tot']."' type='text' disabled = 'disabled' id=\"t_tot".$i."\" class='subBox' onchange='check_integer()'  ></td></td>
	
    <td width='30' height='30' class='smallCell'><input name='hw1' value='".$sheetObject['hw1']."' type='text' maxlength='3' id='hw1".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw1".$i."\", \"5\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='hw2' value='".$sheetObject['hw2']."' type='text' maxlength='3' id='hw2".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw2".$i."\", \"5\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='hw3' value='".$sheetObject['hw3']."' type='text' maxlength='3' id='hw3".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw3".$i."\", \"5\")'  ></td>
    <td width='30' height='30' class='smallCell'><input name='hw4' value='".$sheetObject['hw4']."' type='text' maxlength='3' id='hw4".$i."' class='smallBox' onkeyup='check_integer_Hw(\"hw4".$i."\", \"5\")'  ></td>
    <td width='40' height='30' ><input name='hw_tot' value='".$sheetObject['hw_tot']."' type='text' disabled = 'disabled' id=\"hw_tot".$i."\" class='subBox'  ></td></td>
	
    <td width='60' height='30' ><input name='c_subtot' value='".$sheetObject['c_subtot']."' type='text' disabled = 'disabled' id=\"c_subtot".$i."\" class='totBox'  ></td></td>
    <td width='60' height='30' ><input name='c_subtot30' value='".$sheetObject['c_subtot30']."' type='text' disabled = 'disabled' id=\"c_subtot30".$i."\" class='totBox' onchange='add_overall(\"".$i."\")' ></td>
    <td width='60' height='30' class='smallCell'><input name='exams100' value='".$sheetObject['exam100']."' type='text'maxlength='5' id=\"exam100".$i."\" class='examBox' onkeyup='calcexam70(\"".$i."\", \"100\")'  ></td>
    <td width='60' height='30'><input name='exams70' value='".$sheetObject['exam70']."' type='text' disabled = 'disabled' id=\"exam70".$i."\" class='totBox'  ></td>
    <td width='60' height='30'><input name='overall30_70' value='".$sheetObject['overall30_70']."' type='text' disabled = 'disabled' id=\"overall30_70".$i."\" class='totBox' ></td>
	<td width='60' height='30'><input name='grade' value='".$sheetObject['grade']."' type='text' disabled = 'disabled' id=\"grade".$i."\" class='totBox' ></td>
    <td width='60' height='30'><input name='position' value='".$sheetObject['position']."' type='text' disabled = 'disabled' id=\"position".$i."\" class='totBox' ></td>
    <td width='200' height='30'><input name='remarks' value='".$sheetObject['remarks']."' type='text' disabled = 'disabled' id=\"remarks".$i."\" class='remarksBox' ></td> 
	 ";
	}
	 echo "</tr>";
	
   ?>
   </tr>
</table>
