<?php 
	require_once("includes/session.php"); 
 	require_once("includes/functions.php");
	confirm_logged_in();
 	 
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	
	$sel_class_id = $_GET['select_class'];
	$sel_term = $_GET['select_term'];
	$sel_year = $_GET['select_year'];
	
	
	$q="SELECT * FROM classes WHERE class_id = '$sel_class_id'";
  		$sel_class = mysql_query($q);
		$sel_classArray = mysql_fetch_array($sel_class);
		$sel_class_name = $sel_classArray['class_name'];
	

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
<title>Print Terminal Reports</title>
<link rel="shortcut icon" href="images/ass_icon.png">
<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
<style type="text/css">
body {font-size:12px;
font-family:Arial, Helvetica, sans-serif;}
.logoDiv {
	margin-left:auto;
	margin-right:auto;
	display: block;
	
}
#mainDiv #title {
	text-align: center;
}

.detailsTab {
	margin-right: auto;
	margin-left: auto;
}

.figuresTab {
	margin-right: auto;
	margin-left: auto;
	text-align: center;
	vertical-align: middle;
	border-collapse:collapse;
	border:1px solid ;
}
#mainDiv #figuresDiv .figuresTab tr .subjTH {
	text-align: left;
}
.sidebarDiv {
	padding-top: 200px;
	border-right-width: 1px;
	min-height: 1000px;
	background-color:#EFEFEF;
	padding-left:10px;
	padding-right:10px;
	
	}
	
	
</style>
<script type="text/javascript" src="javascripts/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="javascripts/print.js"></script>
<script type="text/javascript" src="javascripts/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#ntb" ).datepicker({dateFormat: 'dd MM, yy'});
   
  });
</script>
</head>

<body>

<ul style="margin:auto; padding:0px;">
    <li style="display:inline-block; list-style:none; width:180px; ">

<div class="sidebarDiv">
		<p><strong>Students in <?php echo $sel_class_name; ?></strong><br /></p>
		<em>Boys</em><br />
	<?php 
		$q3 = "SELECT * FROM students WHERE class_id ='$sel_class_id' AND gender = 'male' ORDER BY lname";
		$result3 = mysql_query($q3);
		 $i=0; //set identifiers for different row numbers
		 echo "<input type='hidden' value='$sel_class_id' id='sel_class_id' />";//hidden input for storing class_id value
		 
		while($students = mysql_fetch_array($result3)) {
			$i = $i + 1;
		echo "<input type='hidden' value='".$students['student_id']."' id='student_id".$i."' />";
		echo "<a href='#' onClick='load_report(".$i.")'>". $students['lname'] . " " . $students['fname']. "</a><br />";
		}
		?>
        <br />
		<em>Girls</em>
        <br />
		<?php
		$q6 = "SELECT * FROM students WHERE class_id ='$sel_class_id' AND gender = 'female' ORDER BY lname";
		$result6 = mysql_query($q6);
		 //set identifiers for different row numbers
		 echo "<input type='hidden' value='$sel_class_id' id='sel_class_id' />";//hidden input for storing class_id value
		 
		while($students = mysql_fetch_array($result6)) {
			$i = $i + 1;
		echo "<input type='hidden' value='".$students['student_id']."' id='student_id".$i."' />";
		echo "<a href='#' onClick='load_report(".$i.")'>". $students['lname'] . " " . $students['fname']. "</a><br />";
		}
		
		
	?>
    <br /> <hr />
    Promoted to:
     <select id="promoted_to" name="promoted_to" size="1" class="span2" onChange="reload_page()" >
        <option value="N 1">N 1</option>
        <option value="N 2">N 2</option>
        <option value="KG 1">KG 1</option>
        <option value="KG 2">KG 2</option>
        <option value="CLASS 1">CLASS 1</option>
        <option value="CLASS 2">CLASS 2</option>
        <option value="CLASS 3">CLASS 3</option>
        <option value="CLASS 4">CLASS 4</option>
        <option value="CLASS 5">CLASS 5</option>
        <option value="CLASS 6">CLASS 6</option>
        <option value="JHS 1">JHS 1</option>
        <option value="JHS 2">JHS 2</option>
        <option value="JHS 3">JHS 3</option>
        </select>
        <br />
    <!-- Total No. of days in the term:
     	<input type="number" class="span2" id="tot_att"/>
        <br />
     Next term begins:
        <input type="text" id="ntb" class="span2" />-->
       
        <hr />
        <p><a href="index.php" class="btn btn-small"><i class="icon-arrow-left" on></i>&nbsp;Back</a>
           <a href="javascript:void()" class="btn btn-small" onClick="print_report()" ><i class="icon-print" ></i>&nbsp;Print</a>  <br /> <br />    
           <!--<a href="" class=" btn btn-small btn-block btn-primary">Print All</a>--></p>
</div>
    </li>
    <li style="display:inline-block; list-style:none; vertical-align:top; width:990px;"><!--mainDiv-->
      <div id="mainDiv">
        <div class="logoDiv"><img src="images/omega logo.png" width="180" height="150" class="logoDiv"/>
          <h3 id="title" style="text-align:center;">PUPIL'S TERMINAL REPORT</h3>
      </div><!--logoDiv-->
        <br /> <br /> <br />
      <div id="bodyDiv"></div>
      </div>
    </li>
</ul>

<script language="javascript" type="text/javascript">
	$(document).ready(function() { //loads first student report by default
		load_report('1');
		
		 $('#sidebarDiv').slimScroll({
        height: $(window).height() + 'px',
		color: '#000',
		size: '8px',
		railVisible: true,
		railColor: '#09C',
		opacity: 0.6
    });
	}
		);

	function print_report() {
		var att1Val = $('#att1').val();
		$('#att1Span').text(att1Val);
		
		var att2Val = $('#att2').val();
		$('#att2Span').text(att2Val);
		
		var ntbVal = $('#ntb').val();
		$('#ntbSpan').text(ntbVal);
		
		var conductVal = $('#conduct').val();
		$('#conductSpan').text(conductVal);
		
		var attitudeVal = $('#attitude').val();
		$('#attitudeSpan').text(attitudeVal);
		
		var interestVal = $('#interest').val();
		$('#interestSpan').text(interestVal);
		
		var fmrVal = $('#fmr').val();
		$('#fmrSpan').text(fmrVal);
		
		var sfacVal = $('#sfac').val();
		$('#sfacSpan').text(sfacVal);
		
		var smrVal = $('#smr').val();
		$('#smrSpan').text(smrVal);
		
		
		$('#mainDiv').print();
		
		alert('Please click on student\'s name to edit');
	}

	function load_report(row_num) {
		var student_id = encodeURIComponent(document.getElementById('student_id'+row_num).value);
		var class_id = encodeURIComponent(document.getElementById('sel_class_id').value);
		var promoted_to = escape(document.getElementById('promoted_to').options[document.getElementById('promoted_to').selectedIndex].value);
	/*	var tot_att = encodeURIComponent(document.getElementById('tot_att').value);
		var ntb = encodeURIComponent(document.getElementById('ntb').value);*/
		var term = "<?php echo $sel_term; ?>" ;
		var year = "<?php echo $sel_year; ?>" ;			
		var url = 'bodyDiv.php?class_id='+class_id+'&student_id='+student_id+'&term='+term+'&year='+year+'&promoted_to='+promoted_to/*+'&tot_att='+tot_att+'&ntb='+ntb*/;
		$('#bodyDiv').load(url);
		
		//GetCellValues();
		}
		
		/*
		function GetCellValues() {
			
			var table = document.getElementById('figurestab');
			for (var r = 0, n = table.cells.length; r < n; r=r+1) {
				for (var c = 0, m = table.rows[r].cells.length; c < m; c=c+1) {
					alert(table.rows[r].rows[c].innerHTML);
				}
			}
		}*/
		
	function reload_page() {
	
		var student_id = encodeURIComponent(document.getElementById('student_id'+row_num).value);
			alert('dfdv');
		var class_id = encodeURIComponent(document.getElementById('sel_class_id').value);
		var promoted_to = escape(document.getElementById('promoted_to').options[document.getElementById('promoted_to').selectedIndex].value);
		var term = "<?php echo $sel_term; ?>" ;
		var year = "<?php echo $sel_year; ?>" ;			
		var url = 'bodyDiv.php?class_id='+class_id+'&student_id='+student_id+'&term='+term+'&year='+year+'&promoted_to='+promoted_to;
		$('#bodyDiv').load(url);
	}
</script>



</body>
</html>