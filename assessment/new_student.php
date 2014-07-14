<?php
	require_once("includes/session.php"); 
 	require_once("includes/functions.php");
	confirm_logged_in();
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	$success = "";

if (isset($_POST['submit'])) {
	$student_id = "DV".date('YmdHis');
	$lname = trim(mysql_prep($_POST['lname']));
	$fname = trim(mysql_prep($_POST['fname']));
	$gender = trim(mysql_prep($_POST['gender']));
	$class_id = trim(mysql_prep($_POST['class_id']));
	$lname = ucwords($lname);
	$fname = ucwords($fname);
	$query = "INSERT INTO students
	(student_id, class_id, lname, fname, gender)
	VALUES
	('$student_id', '$class_id', '$lname', '$fname', '$gender')";

	$result = mysql_query($query);
	if ($result) {
		$succes = "<div class=\"span6 offset4\" > <div class=\"alert alert-success\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Success!</h4>
		  $lname $fname has been successfully added. 
			</div>
			</div> <br />";
			} else {
				
		$succes =  "<div class=\"span6 offset4\" > <div class=\"alert alert-error\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Error!</h4>
		  Student could not be added. <br />
			</div>
			</div> <br />";
			}
			} else {
	
	$student_id = "";
	$lname = "";
	$fname = "";
	$gender = "";
	$class_id = "";	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Assessment Manager &middot; New Staff Member</title>
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
              <li class="active"><a href="new_student.php">Students</a></li>
              <li><a href="new_class.php">Classes</a></li>
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
     <div class="row">
	 <?php echo $success; ?>
	<div class="span6">
      <form class="form-signin" action="new_student.php" method="post" enctype="multipart/form-data" onsubmit="check_empty()" name="form1">
        <h3 class="form-signin-heading">Add a New Student</h3>
  <div class="control-group">
    <label class="control-label" for="lname">Surname</label>
    <div class="controls">
      <input id="lname" name="lname" type="text" required class = "capitalizefirstletter" placeholder="Surname"/>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="fname">First Name</label>
    <div class="controls">
      <input id="fname" name="fname" type="text" required class = "capitalizefirstletter" placeholder="First Name"/>
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="gender">Gender</label>
    <div class="controls">
      <select name="gender">
      <option value="male">Male</option>
      <option value="female">Female</option>
    </select>
    </div>
  	</div>
    <div class="control-group">
    <label class="control-label" for="class_id">Class</label>
    <div class="controls">
      <select name="class_id" >
    <?php //populating it with the registered classes
	$q ="SELECT * FROM classes";
	$results = mysql_query($q) or die (mysql_error());
	while($classes = mysql_fetch_array($results)) {
		$className = $classes['class_name'];
		$classID = $classes['class_id'];
	echo "<option value='".$classID."'>".$className."</option>";    
	}
        ?>
	</select>
    </div>
  	</div>
  
    	<p>
    	  <input type="submit" id="submit" name="submit" class="btn"/>
    	  &nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
  	  </p>
       </form>
    <p>
      <form action="upload_file.php" method="post" enctype="multipart/form-data">
      <label for="import_excel">...import via Excel</label>
      <input type="file" name="import_excel" id="import_excel">
      <input type="submit" name="submit" value="Submit">
      </form>
    </p>
     
	</div>
    
    <div class="span3">
    <h4>Students</h4>
    <?php //display students and their classes
		$q2 = "SELECT * FROM classes";
		$result2 = mysql_query($q2) or die (mysql_error());
		while($classes = mysql_fetch_array($result2)) {
		echo "<h5 class='text-info'>" . $classes['class_name'] . "</h5>";
		$classid = $classes['class_id'];
		$q3 = "SELECT * FROM students WHERE class_id = '$classid'";
		$result3 = mysql_query($q3) or die (mysql_error());
		while($students = mysql_fetch_array($result3)) {
		echo "<li>". $students['lname'] . " " . $students['fname'] . "</li>";
		}
	}
	?>
    </div>
    </div> <!-- /container -->
    
	<script>
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
