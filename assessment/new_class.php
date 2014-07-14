<?php
	require_once("includes/session.php"); 
 	require_once("includes/functions.php");
	confirm_logged_in();
	 
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");


if (isset($_POST['submit'])) {
	$class_id = "C".date('YmdHis');
	$class_name = trim(mysql_prep($_POST['class_id']));
	$subjects = ($_POST['subject']);
	
	$subjIds = "";
	for ($i=0; $i<count($subjects); $i++)
	{  
		$subjIds = $subjIds.trim(mysql_prep($subjects[$i])).",";   
	}
	

	$subjIds = substr($subjIds, 0, -1); 
	$subjIdsArray = explode(",", $subjIds);
	

	$query = "INSERT INTO classes
	(class_id, class_name, subjects)
	VALUES
	('$class_id', '$class_name', '$subjIds')";

	$result = mysql_query($query);
	if ($result) {//checks errors
				echo  "<div class=\"span6 offset4\" > <div class=\"alert alert-sucess\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Success!</h4>
		  '$class_name' has been successfully added. 
			</div>
			</div> ";
			} else {
				
	echo  "<div class=\"span6 offset4\" > <div class=\"alert alert-error\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Error!</h4>
		  '$class_name' could not be added. <br />
		  Plaese check if it already exists in the list of registered classes.
			</div>
			</div>";
	
			}
	
	} else {
	$class_id = "";
	$class_name = "";	} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Assessment Manager &middot; New Class</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
   <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
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
          <a class="brand" href="index.php">Assessment Manager</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="tables.php">Sheets</a></li>
              <li><a href="new_staff.php">Staff</a></li>
              <li><a href="new_student.php">Students</a></li>
              <li class="active"><a href="new_class.php">Classes</a></li>
              <li><a href="new_subject.php">Subjects</a></li>
            </ul>
            <ul class="nav ace-nav pull-right">
			<span id="user_info">
				<strong class="text-info">Welcome,
				<?php echo $_SESSION['fname']; ?> <br />
                <?php echo date('D').", ".date('jS')." ".date('F')." ".date('Y'); ?></strong>&nbsp;
                <small class="text-warning"><a href="logout.php" class="btn-danger btn-mini"><i class="icon-off"></i>Log out</a></small>
			</span>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	
     <div class="container">
     <div class="row span12">
	<div class="span6">
      <form class="form-signin" action="new_class.php" method="post" enctype="multipart/form-data" onSubmit="checkboxes()" name="form1">
        <h3 class="form-signin-heading">Add a new Class</h3>
        <select name="class_id" size="1" class="span2">
        <option value="N 1">N 1</option>
        <option value="N 1A">N 1A</option>
        <option value="N 1B">N 1B</option>
        <option value="N 2">N 2</option>
        <option value="N 2A">N 2A</option>
        <option value="N 2B">N 2B</option>
        <option value="KG 1">KG 1</option>
        <option value="KG 1A">KG 1A</option>
        <option value="KG 1B">KG 1B</option>
        <option value="KG 2">KG 2</option>
        <option value="KG 2A">KG 2A</option>
        <option value="KG 2B">KG 2B</option>
        <option value="CLASS 1">CLASS 1</option>
        <option value="CLASS 1A">CLASS 1A</option>
        <option value="CLASS 1B">CLASS 1B</option>
        <option value="CLASS 2">CLASS 2</option>
        <option value="CLASS 2A">CLASS 2A</option>
        <option value="CLASS 2B">CLASS 2B</option>
        <option value="CLASS 3">CLASS 3</option>
        <option value="CLASS 3A">CLASS 3A</option>
        <option value="CLASS 3B">CLASS 3B</option>
        <option value="CLASS 4">CLASS 4</option>
        <option value="CLASS 4A">CLASS 4A</option>
        <option value="CLASS 4B">CLASS 4B</option>
        <option value="CLASS 5">CLASS 5</option>
        <option value="CLASS 5A">CLASS 5A</option>
        <option value="CLASS 5B">CLASS 5B</option>
        <option value="CLASS 6">CLASS 6</option>
        <option value="CLASS 6A">CLASS 6A</option>
        <option value="CLASS 6B">CLASS 6B</option>
        <option value="JHS 1">JHS 1</option>
        <option value="JHS 1A">JHS 1A</option>
        <option value="JHS 1B">JHS 1B</option>
        <option value="JHS 2">JHS 2</option>
        <option value="JHS 2A">JHS 2A</option>
        <option value="JHS 2B">JHS 2B</option>
        <option value="JHS 3">JHS 3</option>
        <option value="JHS 3A">JHS 3A</option>
        <option value="JHS 3B">JHS 3B</option>
        </select>
        <br />
        <p class="text-info">Select Subjects:</p>
        
        <?php 
		$q = "SELECT * FROM subjects";
		$results = mysql_query($q) or die (mysql_error());
	while($subjects = mysql_fetch_array($results)) {
		$subjName = $subjects['subject_name'];
		$subjID = $subjects['subject_id'];
	 echo "<label class=\"checkbox\"><input name='subject[]' type='checkbox' value=".$subjID. " />".$subjName."</label>";
	}
	?> 
    
    	<input type="submit" id="submit" name="submit" class="btn"/>
        &nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
      </form>
	</div>
    
    
   
    <!--delete Modal box -->
    <div id="class_listDiv" class="span3"></div>  <!--div that gets filled with the  subject list-->
	
       <div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel" class="text-error">Confirm Delete</h3>
      </div>
      <div class="modal-body">
        <p id="confirmDiv"></p>
        <input type='hidden' id='classid' value=''>  <!--stores the Id to be passed to the ajax-->
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">No</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onClick="deleteClass()">Yes</button>
      </div>
    </div>
    
    <!--edit Modal box -->
    <div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel" class="text-info">Edit Class</h3>
      </div>
      <div class="modal-body">
        <div class="span6">
      <form class="form-signin" action="new_class.php" method="post" enctype="multipart/form-data" onSubmit="checkboxes()" name="form1">
        <input type="hidden" id="classid" value=""/>
        <p class="text-info">Select Subjects:</p>
        
        <?php 
		$q = "SELECT * FROM subjects";
		$results = mysql_query($q) or die (mysql_error());
		
		$class_subjsID = substr($class_subjsID, 0, -1);
		 $class_subjsIDArray = explode(",", $class_subjsID);
		
	while($subjects = mysql_fetch_array($results)) {
		$subjName = $subjects['subject_name'];
		$subjID = $subjects['subject_id'];
		
		$q2 = "SELECT * FROM classes WHERE class_id = 'C20130802133231'";
		$results2 = mysql_query($q2) or die (mysql_error());
		while($classes = mysql_fetch_array($results2)) {
			$class_subjsID = $classes['subjects'];
			
		}
		
		 
		 if (array_key_exists($subjID,$class_subjsIDArray))
			{
	 echo "<label class=\"checkbox\"><input name='subject[]' type='checkbox' checked value=".$subjID. " />".$subjName."</label>";
			}
			else
			{
	echo "<label class=\"checkbox\"><input name='subject[]' type='checkbox'  value=".$subjID. " />".$subjName."</label>";
			}  
	}
	?> 
    
    	<input type="submit" id="submit" name="submit" class="btn"/>
        &nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
      </form>
	</div>
      </div>
      <div class="modal-footer">
        <button class="btn " data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" onClick="editSubject()">Save Changes</button>
        </form>
      </div>
    </div>
    
    </div>
    </div> <!-- /container -->
    
	<script>
	 //loads the class list div from another file load_class_list.php
	$('#class_listDiv').load('load_class_list.php');
	
	function showMsg(subj,id) { //fills the modal body
		  $('#confirmDiv').text('Are you sure you want to delete '+subj+'?');
		  $('#classid').val(id);
	  }
	  
	 function deleteClass() {
		  
		  var classid = $('#classid').val();       //getting the values from the hidden input
		  var dataString = 'class_id='+ classid;  //assigning the values to a post string to be sent via ajax
		  
		  //ajax to perform delete
		  $.ajax({
			type: "POST",
			url	: "delete_class.php",
			data: dataString,
			success: function(param) {
			$('#responseDiv').html('<b>Success</b>');   //not functionin atm
			$('#class_listDiv').load('load_class_list.php'); //reloads the subject list from another file load_subject_list.php
			}
		   });
	  }
	
	 function fill_input(subj, id) { //function to edit class
		  $('#edit_class_name').val(subj); //fills edit subject input with the already existing name  
		  $('#classid').val(id);      //fills hidden input with thw already existing id 
	 }
	
	
	  function editClass() {
		 var subj =$('#edit_subject_name').val(); 
		  var id = $('#subjid').val();
		  var dataString = 'subject_id='+ id + '&subject_name=' + subj;
		  
		  //ajax to perform update
		  $.ajax({
			type: "POST",
			url	: "edit_subject.php",
			data: dataString,
			success: function(param) {
			$('#responseDiv').html('<b>Success</b>');  //not functionin atm
			$('#subj_listDiv').load('load_subject_list.php'); //reloads the subject list from another file load_subject_list.php
			}
		   });
		  }
	
  function checkboxes() {
	$(function(){
      $('#submit').click(function(){
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
      });
    });
  }
  </script>
  
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
