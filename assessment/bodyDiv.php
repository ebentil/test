<?php
	  $connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	  mysql_select_db("assessment") or die ("cannot select DB");
	
	  $student_id = $_GET['student_id'];
	  $class_id = $_GET['class_id'];
	  $term = $_GET['term'];
	  $year = $_GET['year'];
	  $promoted_to = $_GET['promoted_to'];
	  $tot_att = $_GET['tot_att'];
	  //$ntb = $_GET['ntb'];
	  
	  $q="SELECT * FROM classes WHERE class_id = '$class_id'";
	  $sel_class = mysql_query($q);
	  $sel_classArray = mysql_fetch_array($sel_class);
	  $sel_class_name = $sel_classArray['class_name'];
    
?>
    
    
    <div id="detailsDiv">
<?php 
		$q2 = "SELECT * FROM students WHERE class_id = '$class_id'";
		$no_studQuery = mysql_query($q2);
		$no_stud = mysql_num_rows($no_studQuery);
		
		$q3 = "SELECT * FROM students WHERE student_id = '$student_id'";
		$studQuery = mysql_query($q3);
		$studObject = mysql_fetch_array($studQuery);
		$lname = $studObject['lname'];
		$fname = $studObject['fname'];
		$gender = $studObject['gender'];
		
		if ($gender=='male') {
			$pronoun = 'He';
		} elseif ($gender=='female') {
			$pronoun = 'She';
		}
		
		if ($gender=='male') {
			$pronoun2 = 'his';
		} elseif ($gender=='female') {
			$pronoun2 = 'her';
		}
?>
          <table width="962"  border="0" cellpadding="3" cellspacing="0"  class="detailsTab">
            <tr>
              <td width="92">Name of Pupil:</td>
              <td colspan="5"><strong><?php echo $studObject['lname']." ".$studObject['fname']; ?></strong></td>
              <td colspan="2"> Class:&nbsp;<strong><?php echo $sel_class_name; ?></strong></td>
            </tr>
            <tr>
              <td width="92">Number on Roll: </td>
              <td width="100"><strong><?php echo $no_stud; ?></strong></td>
              <td width="31">Term:</td>
              <td width="145"><strong><?php echo $term; ?></strong></td>
              <td width="27">Year:</td>
              <td width="223"><strong><?php echo $year; ?></strong></td>
              <td>Promoted to:</td>
              <td width="222"><strong><?php echo $promoted_to; ?></strong></td>
            </tr>
          </table>
   </div> <!--detailsDiv-->
        <?php 
		$sel_class_subjs = $sel_classArray['subjects'];
		
		//$sel_class_subjs = substr($sel_class_subjs, 0, -1);  
		$subjIdsArray = explode(",", $sel_class_subjs); 
		
		/*
		 $sql = "SELECT * FROM sheets WHERE class_id = $class_id AND student_id = 'DV20130806101428'";
		 $sheetQuery = mysql_query($sql) or die (mysql_error());
		 $sheetObject = mysql_fetch_array($sheetQuery);
		*/
		?>
        <br /><br />
<div id ="figuresDiv">
          <table width="969" border="1" cellpadding="0" cellspacing="0" class="figuresTab" id="figurestab">
            <tr>
              <th width="327" scope="col">Subject</th>
              <th width="117" scope="col">Class <br />
                Scores <br />
                30%</th>
              <th width="117" scope="col">Exam <br />
                Score <br />
                70%</th>
              <th width="117" scope="col">Total <br />
                Score <br />
                100%</th>
              <th width="117" scope="col">Grade</th>
              <th width="160" scope="col">Remarks</th>
            </tr>
<?php  
$total30 = 0;
$total70 = 0;
$total100 = 0;
		foreach ($subjIdsArray as $subjID) {
  	$q2 = "SELECT * FROM subjects WHERE subject_id = '$subjID'";   //sends a query with each subjID to retrieve the subj names
	$result2 = mysql_query($q2) or die (mysql_error());
	
	while($subjects = mysql_fetch_array($result2)) {
		$i = $i + 1; if ($i % 2) { $cellColor = "#FFFFFF";} else { $cellColor = "#D3EFF6";} $hoverColor = "#f5f2d4";
	$subjName = $subjects['subject_name'];
	
	
	$q4 = "SELECT * FROM sheets WHERE class_id = '$class_id' AND student_id = '$student_id' AND subject_id = '$subjID' AND term = '$term' AND year = '$year'";
	$result4 = mysql_query($q4) or die (mysql_error());
	
	while($scores = mysql_fetch_array($result4)) {
		
		$class30 = $scores['c_subtot30'];
		$exam70 = $scores['exam70'];
		$overall = $scores['overall30_70'];
		$grade = $scores['grade'];
		$remarks = $scores['remarks'];
		
		$total30 = $total30 + $class30;
		$total70 = $total70 + $exam70;
		$total100 = $total100 + $overall;
?>
            <tr style="height:25px" onMouseover="this.bgColor='<?php echo $hoverColor; ?>'" onMouseout="this.bgColor='<?php echo $cellColor; ?>'" bgColor='<?php echo $cellColor; ?>'>
              <th align="left" valign="middle" class="subjTH" scope="row" >&nbsp;&nbsp;<?php echo $subjName; ?></th>
              <td><? echo $class30; ?></td>
              <td><? echo $exam70; ?></td>
              <td><? echo $overall; ?></td>
              <td><? echo $grade; ?></td>
              <td><? echo $remarks; ?></td>
            </tr>
            <?php }  //end of while loop
			} //end of while loop
 	
	 } // end of foreach loop
  
   ?>
   			<tr style="height:25px" >
              <td colspan="6"></td>
            </tr>
   		   <tr style="height:35px" >
              <th scope="row" class="subjTH" >&nbsp;&nbsp;Total Scores:</th>
              <td><?php echo $total30; ?></td>
              <td><?php echo $total70; ?></td>
              <td><?php echo $total100; ?></td>
              <th align = "left" colspan="2">&nbsp;&nbsp;Overall Position in Class:&nbsp;xxxxx</th>
            </tr>
          </table>
        </div><!--figuresDiv-->
      <br /><br />
        
<?php 
			$q5 = "SELECT * FROM reports WHERE student_id = '$student_id' AND class_id = '$class_id' AND term = '$term' AND year = '$year' ";
			$result5 = mysql_query($q5) or die (mysql_error());
			$report_records = mysql_fetch_array($result5);
			
			$att1 = $report_records['att1'];
			$att2 = $report_records['att2'];
			$ntb = $report_records['next_term_begins'];
			$conduct = $report_records['conduct'];
			$attitude = $report_records['attitude'];
			$interest = $report_records['interest'];
			$fmr = $report_records['form_master_remarks'];
			$sfac = $report_records['sch_fees'];
			$smr = $report_records['sch_mgr_remarks'];
		 ?>
        <div id = "remarksDiv">
          <p>&nbsp; &nbsp;&nbsp; Attendance: &nbsp;           
            <span style="width:50px; border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="att1Span"><input type="text" id="att1"  style="width:50px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" onkeyup="insert_report()" value="<?php echo $att1; ?>"/></span>
             out of &nbsp; 
             <span style="width:50px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="att2Span" ><input type="text" id="att2" style="width:50px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" onkeyup="insert_report()" value="<?php echo $att2; ?>" /></span>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Next term begins: &nbsp; 
          <span style="width:100px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="ntbSpan"><input type="text" id="ntb"  style="width:100px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" placeholder="dd/mm/yyyy" value="<?php echo $ntb; ?>" onkeyup="insert_report()"/></span></p>
          
           <p>&nbsp; &nbsp;&nbsp;Conduct: &nbsp; <span style="width:850px; border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="conductSpan" ><select id="conduct"  class="span6" onchange="insert_report()" style ="border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;">
   <option selected="selected" value="-">--- Select Item ---</option>
   <option><?php echo $fname; ?> is an enthusiastic learner who seems to enjoy school.</option>
   <option><?php echo $fname; ?> has become more confident in class.</option>
   <option><?php echo $fname; ?> always appears well prepared for each day's activities.</option>
   <option><?php echo $fname; ?> shows great interest in all classroom activities.</option>
   <option><?php echo $fname; ?> is always committed to doing his/her best.</option>
   <option><?php echo $fname; ?> is a very pleasant student to work with.</option>
   <option><?php echo $fname; ?> is cooperative and well mannered.</option>
   <option><?php echo $fname; ?> always follows classroom rules.</option>
   <option><?php echo $fname; ?> always remains focused on the activity at hand.</option>
   <option><?php echo $fname; ?> shows respect for teachers and peers.</option>
   <option><?php echo $fname; ?> is honest and trustworthy in dealings with others.</option>
   <option><?php echo $fname; ?> makes friends quickly in the classroom.</option>
   <option><?php echo $fname; ?> demonstrates good leadership skills.</option>
   <option><?php echo $fname; ?> always pays attention in class.</option>
   <option><?php echo $fname; ?> completes assignments on time.</option>
   <option><?php echo $fname; ?> always asks for clarification when needed.</option>
   <option><?php echo $fname; ?> is a hard-working student.</option>
   <option value="-" disabled="disabled">--- Difficulties ---</option>
   <option><?php echo $fname; ?> does not pay attention in class.</option>
   <option><?php echo $fname; ?> does not follow instructions.</option>
    <option><?php echo $fname; ?> always comes to school late.</option>
   <option><?php echo $fname; ?> lacks confidence in class.</option>
    <option><?php echo $fname; ?> demonstrates aggressive behaviour.</option>
   <option><?php echo $fname; ?> often seems tired at school.</option>
    <option><?php echo $fname; ?> does not do <?php echo $pronoun2; ?> home work.</option>
   <option><?php echo $fname; ?> sleeps a lot in class.</option>
    <option><?php echo $fname; ?> does not show any seriousness in class.</option>
   <option><?php echo $fname; ?> always struggles to understand simple instructions.</option>
   </select></span></p>
          
      <p>&nbsp; &nbsp;&nbsp;Attitude: &nbsp;  <span style="width:850px; border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="attitudeSpan"><select id="attitude"  class="span6" onchange="insert_report()" style ="border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;">
   <option selected="selected" value="-">--- Select Item ---</option>
   <option><?php echo $pronoun; ?> is an enthusiastic learner who seems to enjoy school.</option>
   <option><?php echo $pronoun; ?> has become more confident in class.</option>
   <option><?php echo $pronoun; ?> always appears well prepared for each day's activities.</option>
   <option><?php echo $pronoun; ?> shows great interest in all classroom activities.</option>
   <option><?php echo $pronoun; ?> is always committed to doing his/her best.</option>
   <option><?php echo $pronoun; ?> is a very pleasant student to work with.</option>
   <option><?php echo $pronoun; ?> is cooperative and well mannered.</option>
   <option><?php echo $pronoun; ?> always follows classroom rules.</option>
   <option><?php echo $pronoun; ?> always remains focused on the activity at hand.</option>
   <option><?php echo $pronoun; ?> shows respect for teachers and peers.</option>
   <option><?php echo $pronoun; ?> is honest and trustworthy in dealings with others.</option>
   <option><?php echo $pronoun; ?> makes friends quickly in the classroom.</option>
   <option><?php echo $pronoun; ?> demonstrates good leadership skills.</option>
   <option><?php echo $pronoun; ?> always pays attention in class.</option>
   <option><?php echo $pronoun; ?> completes assignments on time.</option>
   <option><?php echo $pronoun; ?> always asks for clarification when needed.</option>
   <option><?php echo $pronoun; ?> is a hard-working student.</option>
   <option value="-" disabled="disabled">--- Difficulties ---</option>
   <option><?php echo $pronoun; ?> does not pay attention in class.</option>
   <option><?php echo $pronoun; ?> does not follow instructions.</option>
    <option><?php echo $pronoun; ?> always comes to school late.</option>
   <option><?php echo $pronoun; ?> lacks confidence in class.</option>
    <option><?php echo $pronoun; ?> demonstrates aggressive behaviour.</option>
   <option><?php echo $pronoun; ?> often seems tired at school.</option>
    <option><?php echo $pronoun; ?> does not do <?php echo $pronoun2; ?> home work.</option>
   <option><?php echo $pronoun; ?> sleeps a lot in class.</option>
    <option><?php echo $pronoun; ?> does not show any seriousness in class.</option>
   <option><?php echo $pronoun; ?> always struggles to understand simple instructions.</option>
   </select></span></p>
   
   <p>&nbsp; &nbsp;&nbsp;Interest: &nbsp; <span style="width:900px; border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="interestSpan" ><select id="interest" class="span6" onchange="insert_report()" style ="border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;">
   <option selected="selected" value="-">--- Select Item ---</option>
   <option><?php echo $pronoun; ?> has a good sense of humour.</option>
   <option><?php echo $pronoun; ?> enjoys talking.</option>
   <option><?php echo $pronoun; ?> can sing very well.</option>
   <option><?php echo $pronoun; ?> enjoys reading.</option>
   <option><?php echo $pronoun; ?> does well in Mathematics.</option>
   <option><?php echo $pronoun; ?> does well in Science.</option>
   <option><?php echo $pronoun; ?> is very good at physical activities.</option>
   <option><?php echo $pronoun; ?> is a gifted footballer.</option>
   <option><?php echo $pronoun; ?> is a talented athlete.</option>
   <option><?php echo $pronoun; ?> has a flair for drawing.</option>
   <option><?php echo $pronoun; ?> enjoys sharing <?php echo $pronoun2; ?> ideas with others.</option>
   <option><?php echo $pronoun; ?> enjoys conversation with friends during free periods.</option>
   </select></span></p>
   
    <p>&nbsp; &nbsp;&nbsp;Form Master's Remarks: &nbsp; <span style="width:780px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="fmrSpan"><select id="fmr" class="span8" onchange="insert_report()" style ="border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;">
   <option selected="selected" value="-">--- Select Item ---</option>
   <option><?php echo $pronoun; ?> can do well if he decides to work harder and listens to instructions.</option>
   <option><?php echo $pronoun; ?> is capable of being a successful student with a little effort.</option>
   <option><?php echo $pronoun; ?> can do better if he makes his mind up to work harder.</option>
   <option><?php echo $pronoun; ?> frequently needs to be reminded to be respectful.</option>
   <option>I am pleased to report that  <?php echo $fname; ?> is showing positive development in regards to his attitude in the classroom.</option>
   <option><?php echo $pronoun; ?> needs to improve classroom attitude.</option>
   <option>I would like to see <?php echo $fname; ?> become a more active participant in class discussions.</option>
   <option><?php echo $pronoun; ?> needs to stay focused during lessons.</option>
   <option><?php echo $pronoun; ?> must learn to treat others with respect.</option>
   <option><?php echo $pronoun; ?> needs to complete homework assignments on-time.</option>
   <option><?php echo $pronoun; ?> needs a great deal of adult assistance to complete class work.</option>
   <option><?php echo $pronoun; ?> needs to be encouraged to listen and pay attention in class.</option>
   <option><?php echo $pronoun; ?> would benefit from learning self-control skills.</option>
   </select></span></p>
   
   
   <p>&nbsp;&nbsp;&nbsp; School Manager's Remarks: &nbsp;<span style="width:780px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="smrSpan">
          <select id="smr" class="span6" onchange="insert_report()" style ="border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;">
   <option selected="selected" value="-">--- Select Item ---</option>
   <option><?php echo $pronoun; ?> can do well if he decides to work harder and listens to instructions.</option>
   <option><?php echo $pronoun; ?> is capable of being a successful student with a little effort.</option>
   <option><?php echo $pronoun; ?> can do better if he makes his mind up to work harder.</option>
   <option><?php echo $pronoun; ?> frequently needs to be reminded to be respectful.</option>
   <option>I am pleased to report that  <?php echo $fname; ?> is showing positive development in regards to his attitude in the classroom.</option>
   <option><?php echo $pronoun; ?> needs to improve classroom attitude.</option>
   <option>I would like to see <?php echo $fname; ?> become a more active participant in class discussions.</option>
   <option><?php echo $pronoun; ?> needs to stay focused during lessons.</option>
   <option><?php echo $pronoun; ?> must learn to treat others with respect.</option>
   <option><?php echo $pronoun; ?> needs to complete homework assignments on-time.</option>
   <option><?php echo $pronoun; ?> needs a great deal of adult assistance to complete class work.</option>
   <option><?php echo $pronoun; ?> needs to be encouraged to listen and pay attention in class.</option>
   <option><?php echo $pronoun; ?> would benefit from learning self-control skills.</option>
   </select></span></p>
          
         <!-- <p>&nbsp; &nbsp;&nbsp;Conduct: &nbsp; <span style="width:850px; border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="conductSpan" ><input type="text" id="conduct" style="width:850px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" value="<?php //echo $conduct; ?>" onkeyup="insert_report()"/></span></p>-->
          
          <!--<p>&nbsp; &nbsp;&nbsp;Attitude: &nbsp; <span style="width:850px; border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="attitudeSpan"><input type="text"  id="attitude" style="width:850px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" value="<?php //echo $attitude; ?>" onkeyup="insert_report()"/></span></p>-->
          
          
          
          <!--<p>&nbsp; &nbsp;&nbsp;Interest: &nbsp; <span style="width:900px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="interestSpan" ><input type="text" id="interest" style="width:900px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" value="<?php //echo $interest; ?>" onkeyup="insert_report()" /></span></p>-->
          
         <!-- <p>&nbsp; &nbsp;&nbsp;Form Master's Remarks: &nbsp; <span style="width:780px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="fmrSpan"><input type="text" id="fmr" style="width:780px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" value="<?php //echo $fmr; ?>" onkeyup="insert_report()" /></span></p>-->
          
          <p>&nbsp;&nbsp; &nbsp;School Fees Arrears &amp; Comments: &nbsp;<span style="width:720px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="sfacSpan"><input type="text" id="sfac" style="width:720px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" value="<?php echo $sfac; ?>" onkeyup="insert_report()" /></span></p>
          
          <!--<p>&nbsp;&nbsp;&nbsp; School Manager's Remarks: &nbsp;<span style="width:780px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;" id="smrSpan">
          <input type="text" id="smr" style="width:780px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent;" value="<?php //echo $smr; ?>" onkeyup="insert_report()" /></span></p>-->
          <br /><br />
          <p> &nbsp;
&nbsp; School Manager (signature &amp; stamp)       
   <span style="width:250px;   border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color: #000;">
   <input type="text"  style="width:250px;border:none; font-size:12px; border-bottom-width: 0px;border-bottom-style: solid;border-bottom-color: #000; box-shadow:none; background-color:transparent; " disabled="disabled"/></span></p>
   
   
        </div>
        
<script type="text/javascript">
	//fixes the dropdown list values according to the values from the database
	$('#conduct').val('<?php echo $conduct; ?>');
	$('#attitude').val('<?php echo $attitude; ?>');
	$('#interest').val('<?php echo $interest; ?>');
	$('#fmr').val('<?php echo $fmr; ?>');
	$('#smr').val('<?php echo $smr; ?>');
	
	function insert_report() {
		var student_id = '<?php echo $student_id; ?>';
		var class_id = '<?php echo $class_id; ?>'
		var term = '<?php echo $term; ?>'
		var year = '<?php echo $year; ?>'
		var total30 = '<?php echo $total30; ?>';
		var total70 = '<?php echo $total70; ?>';
		var total100 = '<?php echo $total30; ?>';
		var overall_class = "";
		
		var att1Val = encodeURIComponent($('#att1').val());
		var att2Val = encodeURIComponent($('#att2').val());
		var ntbVal = encodeURIComponent($('#ntb').val());
		var conductVal = encodeURIComponent($('#conduct').val());
		var attitudeVal = encodeURIComponent($('#attitude').val());
		var interestVal = encodeURIComponent($('#interest').val());
		var fmrVal = encodeURIComponent($('#fmr').val());
		var sfacVal = encodeURIComponent($('#sfac').val());
		var smrVal = encodeURIComponent($('#smr').val());
		
		dataString = 'student_id='+ student_id + '&class_id=' + class_id + '&term=' + term + '&year=' + year + '&total30=' + total30 + '&total70=' + total70 + '&total100=' + total100 + '&overall_class=' + overall_class + '&att1Val=' + att1Val + '&att2Val=' + att2Val + '&ntbVal=' + ntbVal + '&conductVal=' + conductVal + '&attitudeVal=' + attitudeVal + '&interestVal=' + interestVal + '&fmrVal=' + fmrVal + '&sfacVal=' + sfacVal + '&smrVal=' + smrVal;
		
		$.ajax({
    	type: "POST",
    	url	: "insert_report.php",
    	data: dataString,
		success: function(param) {
		  $('#responseDiv').html('<b>Success</b>');
		}
   		});
	}
</script>
