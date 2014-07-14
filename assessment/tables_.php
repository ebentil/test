<?php 
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Assessment Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <!--<link href="assets/css/bootstrap.css" rel="stylesheet">-->
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
           
    <!--<link href="stlyesheets/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />-->
    <link href="stylesheets/thestyle.css" rel="stylesheet" type="text/css" media="all" />
    <script src="javascripts/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery-2.0.2.min.js" type="text/javascript"></script>
    <!--<link href="stlyesheets/bootstrap.css" rel="stylesheet" type="text/css" />-->
    <link rel="shortcut icon" href="images/ass_icon.png">

  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    

    <div class="container">

      <!--<h1>Bootstrap starter template</h1>-->
      <p align="center">Please select a class and the subject to work on</p>
<p class="title">
<label class="sels">Class:</label><select name="select_class" size="1" id="select_class" onChange="load_subjects()">
	<?php //populating it with the registered classes
        $q1 ="SELECT * FROM classes";
        $results = mysql_query($q1) or die (mysql_error());
        while($classes = mysql_fetch_array($results)) {
            $className = $classes['class_name'];
            $classID = $classes['class_id'];
        echo "<option value='".$classID."'>".$className."</option>";    
        }
     ?>
</select>
<span id="subjDiv"></span>
<input name="load_sheet" type="button" value="Load Sheet" onClick="load_sheet()" class="load_button" />
</p>

<div id="sheetDiv"></div>

<p>&nbsp;</p>
<script language="javascript" type="text/javascript">
	
	function load_subjects() {
		var theClass = document.getElementById('select_class').options[document.getElementById('select_class').selectedIndex].value;
		$('#subjDiv').load('load_subjects.php?class='+theClass);
		}
		
	function load_sheet() {
		var theClass = escape(document.getElementById('select_class').options[document.getElementById('select_class').selectedIndex].value);
		var subj = escape(document.getElementById('select_subject').options[document.getElementById('select_subject').selectedIndex].value);
		$('#sheetDiv').load('sheet.php?class='+theClass +'&subj=' +subj);
		}
		

	
	function check_integer_Ex(field_id,limit){//check ex values
	  var f_id = field_id;
	var str=document.getElementById(f_id);
	var numbers = /^[0-9.]+$/;
	if (!str.value.match(numbers)) {
	str.value = str.value.substring(0, str.value.length - 1);
		} else {
			if (parseFloat(str.value)>parseFloat(limit)) {
				alert('This value can\'t be more than '+ limit);
				str.value = "";
				} else {
			addEx(f_id);
			}
		}
	}
	
	function addEx(f_id) {
		f_type = f_id.substr(3);
		var field1 = "ex1" + f_type;
		var field2 = "ex2" + f_type;
		var field3 = "ex3" + f_type;
		var field4 = "ex4" + f_type;
		
		var ex_1 =+document.getElementById(field1).value;
		var ex_2 =+document.getElementById(field2).value;
		var ex_3 =+document.getElementById(field3).value;
		var ex_4 =+document.getElementById(field4).value;
		
		 var total = ex_1 + ex_2 + ex_3 + ex_4; 
		//parseInt(total);
		var field_tot = "ex_tot" + f_type;
		document.getElementById(field_tot).value = total;
		addsubs(f_type); //function to add sub totals
		calcsubs30(f_type);
	}

	function check_integer_Test(field_id,limit){//check test values
	  var f_id = field_id;
	  //alert(yy);
	var str=document.getElementById(f_id);
	var numbers = /^[0-9.]+$/;
	if (!str.value.match(numbers)) {
	str.value = str.value.substring(0, str.value.length - 1);
		} else { 
			if (parseFloat(str.value)>parseFloat(limit)) {
				alert('This value can\'t be more than '+ limit);
				str.value = "";
				} else {
			addTest(f_id);
			}
		}
	}

	function addTest(f_id) {
		f_type = f_id.substr(2);
		var field1 = "t1" + f_type;
		var field2 = "t2" + f_type;
		var field3 = "t3" + f_type;
		//var field4 = "ex4" + f_type;
		
		var t_1 =+document.getElementById(field1).value;
		var t_2 =+document.getElementById(field2).value;
		var t_3 =+document.getElementById(field3).value;
		//var ex_4 =+document.getElementById(field4).value;
		
		 var total = t_1 + t_2 + t_3;
		//parseInt(total);
		var field_tot = "t_tot" + f_type;
		
		document.getElementById(field_tot).value = total;
		addsubs(f_type);
		calcsubs30(f_type);
		
	}

	function check_integer_Hw(field_id,limit){//check hw values
		  var f_id = field_id;
		  //alert(yy);
		var str=document.getElementById(f_id);
		var numbers = /^[0-9.]+$/;
		if (!str.value.match(numbers)) {
		str.value = str.value.substring(0, str.value.length - 1);
			} else {
			if (parseFloat(str.value)>parseFloat(limit)) {
				alert('This value can\'t be more than '+ limit);
				str.value = "";
				} else {
				addHw(f_id);
				}
			}
		}

	function addHw(f_id) {
		f_type = f_id.substr(3);
		var field1 = "hw1" + f_type;
		var field2 = "hw2" + f_type;
		var field3 = "hw3" + f_type;
		var field4 = "hw4" + f_type;
		
		var hw_1 =+document.getElementById(field1).value;
		var hw_2 =+document.getElementById(field2).value;
		var hw_3 =+document.getElementById(field3).value;
		var hw_4 =+document.getElementById(field4).value;
		
		 var total = hw_1 + hw_2 + hw_3 + hw_4;
		//parseInt(total);
		var field_tot = "hw_tot" + f_type;
		
		document.getElementById(field_tot).value = total;
		addsubs(f_type);
		calcsubs30(f_type);
	}


	function addsubs(f_type) { //function to add sub totals
	var fieldex = "ex_tot" + f_type;
	var fieldt = "t_tot"+ f_type;
	var fieldhw = "hw_tot" + f_type;
	
	var extot_val =+document.getElementById(fieldex).value;
	var ttol_val =+document.getElementById(fieldt).value;
	var hwtot_val =+document.getElementById(fieldhw).value;
	var ctotal = extot_val + ttol_val + hwtot_val;
	
	var field_csubtot = "c_subtot" + f_type; 
	document.getElementById(field_csubtot).value = ctotal;
	}
	
	function calcsubs30(f_type) {
		var fieldsubtot = "c_subtot" + f_type;
		var ctotal_val =+document.getElementById(fieldsubtot).value;
		var subs30 = ctotal_val * 0.3;	
		var field_subs30 = "c_subtot30" + f_type;
		subs30_float = parseFloat(subs30).toFixed(2);
		document.getElementById(field_subs30).value = subs30_float;
		add_overall(f_type);
	}

	
	function calcexam70(f_type,limit) { 
		var fieldexam = "exam100" + f_type;
		var exam100_val =document.getElementById(fieldexam);
		var numbers = /^[0-9.]+$/;
		if (!exam100_val.value.match(numbers)) {
		exam100_val.value = exam100_val.value.substring(0, exam100_val.value.length - 1);
		} else {
			if (parseFloat(exam100_val.value)>parseFloat(limit)) {
				alert('This value can\'t be more than '+ limit);
				exam100_val.value = "";
				} else {
		var exam70 = exam100_val.value * 0.7;
		var field_exam70 = "exam70" + f_type;
		
		var exam70_float = parseFloat(exam70).toFixed(2);
		document.getElementById(field_exam70).value = exam70_float;
		add_overall(f_type);
		}
		}}
		
	function add_overall(f_type) {
		var fieldsubtot30 = "c_subtot30" + f_type;
		var fieldexam70 = "exam70" + f_type;
		var subtot_val =+document.getElementById(fieldsubtot30).value;
		var exam70_val =+document.getElementById(fieldexam70).value;
		var overall = subtot_val + exam70_val;
		
		var field_overall = "overall30_70" + f_type;
		overall_float = parseFloat(overall).toFixed(2);
		document.getElementById(field_overall).value = overall_float;	
		calcgrade(f_type);
		}
		
		function calcgrade(f_type) {
			var fieldoverall = "overall30_70" + f_type;
			var fieldgrade = "grade" + f_type;
			var fieldremarks = "remarks" + f_type;
			var overall_val =+document.getElementById(fieldoverall).value;
			if (overall_val >= 76 && overall_val <= 100) {
				document.getElementById(fieldgrade).value = "1";
				document.getElementById(fieldremarks).value = "Excellent";
			} else if (overall_val >= 66 && overall_val <= 75) {
				document.getElementById(fieldgrade).value = "2";
				document.getElementById(fieldremarks).value = "Very Good";
			} else if (overall_val >= 56 && overall_val <= 65) {
				document.getElementById(fieldgrade).value = "3";
				document.getElementById(fieldremarks).value = "Good";
			} else if (overall_val >= 51 && overall_val <= 55) {
				document.getElementById(fieldgrade).value = "4";
				document.getElementById(fieldremarks).value = "Satisfactory";
			} else if (overall_val >= 46 && overall_val <= 50) {
				document.getElementById(fieldgrade).value = "5";
				document.getElementById(fieldremarks).value = "Average";
			} else if (overall_val >= 41 && overall_val <= 45) {
				document.getElementById(fieldgrade).value = "6";
				document.getElementById(fieldremarks).value = "Fair";
			} else if (overall_val >= 36 && overall_val <= 40) {
				document.getElementById(fieldgrade).value = "7";
				document.getElementById(fieldremarks).value = "Poor";
			} else if (overall_val >= 30 && overall_val <= 35) {
				document.getElementById(fieldgrade).value = "8";
				document.getElementById(fieldremarks).value = "Very Poor";
			} else if (overall_val >= 0 && overall_val <= 29) {
				document.getElementById(fieldgrade).value = "9";
				document.getElementById(fieldremarks).value = "Fail";
			}
			
			insertdb(f_type);
		}
		
		
function insertdb(rowNumber) {
	var student_id =encodeURIComponent(document.getElementById('student_id'+rowNumber).value);
	var class_id =encodeURIComponent(document.getElementById('class_id'+rowNumber).value);
	var subject_id =encodeURIComponent(document.getElementById('subject_id'+rowNumber).value);
	var ex1 =encodeURIComponent(document.getElementById('ex1'+rowNumber).value);
	var ex2 =encodeURIComponent(document.getElementById('ex2'+rowNumber).value);
	var ex3 =encodeURIComponent(document.getElementById('ex3'+rowNumber).value);
	var ex4 =encodeURIComponent(document.getElementById('ex4'+rowNumber).value);
	var ex_tot =encodeURIComponent(document.getElementById('ex_tot'+rowNumber).value);
	var t1 =encodeURIComponent(document.getElementById('t1'+rowNumber).value); 
	var t2 =encodeURIComponent(document.getElementById('t2'+rowNumber).value);
	var t3 =encodeURIComponent(document.getElementById('t3'+rowNumber).value);
	var t_tot =encodeURIComponent(document.getElementById('t_tot'+rowNumber).value);
	var hw1 =encodeURIComponent(document.getElementById('hw1'+rowNumber).value);
	var hw2 =encodeURIComponent(document.getElementById('hw2'+rowNumber).value);
	var hw3 =encodeURIComponent(document.getElementById('hw3'+rowNumber).value);
	var hw4 =encodeURIComponent(document.getElementById('hw4'+rowNumber).value);
	var hw_tot =encodeURIComponent(document.getElementById('hw_tot'+rowNumber).value);
	var c_subtot =encodeURIComponent(document.getElementById('c_subtot'+rowNumber).value);
	var c_subtot30 =encodeURIComponent(document.getElementById('c_subtot30'+rowNumber).value);
	var exam100 =encodeURIComponent(document.getElementById('exam100'+rowNumber).value);
	var exam70 =encodeURIComponent(document.getElementById('exam70'+rowNumber).value);
	var overall30_70 =encodeURIComponent(document.getElementById('overall30_70'+rowNumber).value);
	var grade =encodeURIComponent(document.getElementById('grade'+rowNumber).value);
	var position =encodeURIComponent(document.getElementById('position'+rowNumber).value);
	var remarks = encodeURIComponent(document.getElementById('remarks'+rowNumber).value);
	
	var dataString = 'student_id='+ student_id + '&class_id=' + class_id + '&subject_id=' + subject_id + '&ex1=' + ex1 + '&ex2=' + ex2 + '&ex3=' + ex3 + '&ex4=' + ex4 + '&ex_tot=' + ex_tot + '&t1=' + t1 + '&t2=' + t2 + '&t3=' + t3 + '&t_tot=' + t_tot + '&hw1=' + hw1 + '&hw2=' + hw2 + '&hw3=' + hw3 + '&hw4=' + hw4 + '&hw_tot=' + hw_tot + '&c_subtot=' + c_subtot + '&c_subtot30=' + c_subtot30 + '&exam100=' + exam100  + '&exam70=' + exam70 + '&overall30_70=' + overall30_70 + '&grade=' + grade + '&position=' + position + '&remarks=' + remarks;	
	
	$.ajax({
    type: "POST",
    url	: "insert.php",
    data: dataString,
	success: function(param) {
		  param
	}
   });
	
	
	//ranking(rowNumber, overall30_70);		
}


/*function ranking(rowNumber, overall30_70) {
	alert(rowNumber);
	var position =  new Array();
	//put values into array
	for (var i = 0; i < <? //echo $no_of_records; ?> i++) {
		var posCell = encodeURIComponent(document.getElementById('overall30_70'+i).value);
		alert(posCell);
		position.push(posCell);
		
	
	alert(position);
	
	}*/
	
	$(document).ready(function() {
		load_subjects();
    });

</script>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
