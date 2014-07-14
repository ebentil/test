<?php
	require_once("includes/session.php"); 
 	require_once("includes/functions.php");
	confirm_logged_in();
	 
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	$success = "";

if (isset($_POST['submit'])) {
	$staff_id = "ST".date('YmdHis');
	$lname = ucwords(trim(mysql_prep($_POST['lname'])));
	$fname = ucwords(trim(mysql_prep($_POST['fname'])));
	$username = trim(mysql_prep($_POST['username']));
	$password1 = trim(mysql_prep($_POST['password']));
	$password = crypt("$password1", 'hx');
	$account_type = $_POST['account_type'];
	$query = "INSERT INTO staff
	(staff_id, lname, fname, username, password, account_type)
	VALUES
	('$staff_id', '$lname', '$fname','$username','$password','$account_type')";

	$result = mysql_query($query) or die (mysql_error());
	if ($result) {
		  $success =  "<div class=\"span8 offset2\" > <div class=\"alert alert-success\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Success!</h4>
		  $lname $fname has been successfully added. 
			</div>
			</div> <br />";
			} else {
				
		  $success = "<div class=\"span6 offset4\" > <div class=\"alert alert-error\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Error!</h4>
		  Staff could not be added. <br />
		  Plaese check if the person already exists in the list of registered staff members.
			</div>
			</div> <br />";
			}
			} else {
	
	$staff_id = "";
	$lname = "";
	$fname = "";
	$username = "";
	$password = "";
	$account_type = "";
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
              <li class="active"><a href="new_staff.php">Staff</a></li>
              <li><a href="new_student.php">Students</a></li>
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
      <form class="form-signin" action="new_staff.php" method="post" enctype="multipart/form-data" onsubmit="check_empty()" name="form1">
        <h3 class="form-signin-heading">Add a Staff Member</h3>
  <div class="control-group">
    <label class="control-label" for="lname">Surname</label>
    <div class="controls">
      <input id="lname" name="lname" type="text" required placeholder="Surname" class = "capitalizefirstletter" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="fname">First Name</label>
    <div class="controls">
      <input id="fname" name="fname" type="text" required placeholder="First Name" class = "capitalizefirstletter" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="username">Username</label>
    <div class="controls">
      <input id="username" name="username" type="text" required placeholder="Username"/>
    </div>
  </div>
  <div class="control-group">
  	<label class="control-label" for="password">Password</label>
    <div class="controls">
     <input id="password" name="password" type="password" required placeholder="Password"/>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="account_type">Account type</label>
    <div class="controls">
      <select name="account_type" id="account_type">
      <option value="Admin">Admin</option>
      <option value="User" selected>User</option>
    </select>
    </div>
  	</div>
    	<input type="submit" id="submit" name="submit" class="btn"/>
        &nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
      </form>
	</div>
    
    <div class="span3">
    <h5>Staff Members</h5>
    <?php
	$q2 = "SELECT * FROM staff ORDER BY lname ASC";
	$result2 = mysql_query($q2) or die (mysql_error());
	while($staff = mysql_fetch_array($result2)) {
		echo "<ul>";
		echo "<li>". $staff['lname'] . " " . $staff['fname'] . "</li>";
		echo "</ul>";
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
