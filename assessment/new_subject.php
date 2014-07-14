<?php
	require_once("includes/session.php"); 
 	require_once("includes/functions.php");
	confirm_logged_in();
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	$success = "";
	
	if (isset($_POST['submit'])) {
		$subject_id = "SUBJ".date('YmdHis');
		$subject_name = trim(mysql_prep($_POST['subject_name']));
		$subject_name = ucwords($subject_name);
	
	$query = "INSERT INTO subjects
	(subject_id, subject_name)
	VALUES
	('$subject_id', '$subject_name')";

	$result = mysql_query($query);
	if ($result) {
			$success =  "<div class=\"span6 offset4\" > <div class=\"alert alert-sucess\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Success!</h4>
		  $subject_name has been successfully added. 
			</div>
			</div> <br />";
			} else {
				
		$success =  "<div class=\"span6 offset4\" > <div class=\"alert alert-error\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Error!</h4>
		  Subject could not be added. <br />
		  Please check if it already exists.
			</div>
			</div> <br />";
			}
			} else {
	$subject_id = "";
	$sname = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Assessment Manager &middot; New Subject</title>
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
	  .capitalizefirstletter {
    	text-transform:capitalize;
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
              <li><a href="new_class.php">Classes</a></li>
              <li class="active"><a href="new_subject.php">Subjects</a></li>
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
     <div class="row">
	 <?php echo $success; ?>
	<div class="span6">
      <form class="form-signin" action="new_subject.php" method="post" enctype="multipart/form-data" onsubmit="check_empty()" name="form1">
        <h3 class="form-signin-heading">Add a New Subject</h3>
  <div class="control-group">
    <label class="control-label" for="subject_name">Subject</label>
    <div class="controls">
      <input class = "capitalizefirstletter input-xlarge" id="subject_name" name="subject_name" type="text" placeholder="Subject
      " required />
    </div>
  </div>
    	<input type="submit" id="submit" name="submit" class="btn"/>
        &nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
      </form>
	</div>
    
    <div id="subj_listDiv" class="span3"></div>  <!--div that gets filled with the  subject list-->
     
    <!--delete Modal box -->
    <div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel" class="text-error">Confirm Delete</h3>
      </div>
      <div class="modal-body">
        <p id="confirmDiv"></p>
        <input type='hidden' id='subjid' value=''>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">No</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onClick="deleteSubject()">Yes</button>
      </div>
    </div>
    
    <!--edit Modal box -->
    <div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="myModalLabel" class="text-info">Edit Subject</h3>
      </div>
      <div class="modal-body">
        <p id="confirmDiv"></p>
        <input type='hidden' id='subjid' value=''>
      
      <form class="form-action" action="new_subject.php" method="post" enctype="multipart/form-data" onsubmit="check_empty()" name="form2">
  <div class="control-group">
    <label class="control-label" for="subject_name">Subject Name</label>
    <div class="controls">
      <input class = "capitalizefirstletter input-xlarge" id="edit_subject_name" name="subject_name" type="text" placeholder="Subject
      " value ="" required />
    </div>
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
	  //loads the subject list div from another file load_subject_list.php
	$('#subj_listDiv').load('load_subject_list.php');
		  
	
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
	  
	  function showMsg(subj,id) { //fills the modal body
		  $('#confirmDiv').text('Are you sure you want to delete '+subj+'?');
		  $('#subjid').val(id);
	  }
	  
	  function deleteSubject() {
		  
		  var subjid = $('#subjid').val();       //getting the values from the hidden input
		  var dataString = 'subject_id='+ subjid;  //assigning the values to a post string to be sent via ajax
		  
		  //ajax to perform delete
		  $.ajax({
			type: "POST",
			url	: "delete_subject.php",
			data: dataString,
			success: function(param) {
			$('#responseDiv').html('<b>Success</b>');   //not functionin atm
			$('#subj_listDiv').load('load_subject_list.php'); //reloads the subject list from another file load_subject_list.php
			}
		   });
	  }
	  
	 function fill_input(subj, id) { //function to edit subjects
		  $('#edit_subject_name').val(subj); //fills edit subject input with the already existing name
		  $('#subjid').val(id);      //fills hidden input with thw already existing id
	 }
	 
	 
	 function editSubject() {
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
