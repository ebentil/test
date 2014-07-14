<?php 
	require_once("includes/session.php");
	require_once("includes/functions.php"); 
	
	bypass_login();
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	$error = "";
	$logoutmsg = "";
	//START FROM PROCESSING
	if (isset($_POST['submit'])) {
		$username = trim(mysql_prep($_POST['username']));
		$password1 = trim(mysql_prep($_POST['password']));
		$password = crypt("$password1", 'hx');
		
		$query = "SELECT staff_id, lname, fname, username, account_type FROM staff WHERE username = '$username' AND password = '$password' LIMIT 1";
		$staffObject = mysql_query($query);
		if (mysql_num_rows($staffObject) == 1) {
			$found_user = mysql_fetch_array($staffObject);
			$_SESSION['user_id'] = $found_user['staff_id'];
			$_SESSION['username'] = $found_user['username'];
			$_SESSION['lname'] = $found_user['lname'];
			$_SESSION['fname'] = $found_user['fname'];
			$_SESSION['account_type'] = $found_user['account_type'];
			redirect_to("index.php");
			} else {
				$error = "<div class=\"span8 offset2\" > <div class=\"alert alert-error\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Login failed!</h4>
		  Username/Password combination incorrect.<br />
		  Please make sure your caps lock key is off and try again
			</div>
			</div> <br />";
			}
		} else {
			$logoutmsg = "<div class=\"span8 offset2\" > <div class=\"alert alert-info\">
		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		  <h4>Logged out!</h4>
		  You have been successfully logged out
			</div>
			</div> <br />";
			$username = "";
			$password = "";
		}
		
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Log In &middot; Assessment System</title>
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
    <link rel="shortcut icon" href="images/ass_icon.png">
  </head>

  <body>

    <div class="container">
    	<?php echo $error; ?>
        <?php if ($_GET['logout'] == 1 ) {echo $logoutmsg;} ?>
        <div>
      <form class="form-signin" action="login.php" method="post" enctype="multipart/form-data" name="form1">
        <h2 class="form-signin-heading">Log In</h2>
        <input type="text" class="input-block-level" placeholder="Username" name="username" id="username" autocomplete="off" required>
        <input type="password" class="input-block-level" placeholder="Password" name="password" id="password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-large btn-primary" type="submit" id="submit" name="submit">Sign in</button>
      </form>
		</div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <!--<script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
-->
  </body>
</html>
