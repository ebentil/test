<?php 
	require_once("includes/session.php"); 
 	require_once("includes/functions.php");
	confirm_logged_in();
 	include("includes/header.php"); 
	
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	$account_type = $_SESSION['account_type'];
?>

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
              <li class="active"><a href="index.php">Home</a></li>
           <?php if($account_type == "Admin") {?> <li><a href="tables.php">Sheets</a></li> <?php } ?>
           <?php if($account_type == "Admin") {?> <li><a href="new_staff.php">Staff</a></li> <?php } ?>
           <?php if($account_type == "Admin") {?> <li><a href="new_student.php">Students</a></li> <?php } ?>
           <?php if($account_type == "Admin") {?> <li><a href="new_class.php">Classes</a></li> <?php } ?>
           <?php if($account_type == "Admin") {?> <li><a href="new_subject.php">Subjects</a></li> <?php } ?>
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

    <div class="container row-fluid">
	<div class="row-fluid">
      <h3 align="center" class="text-info">Actions</h3><h4 align="center"></h4>
      <p align="center"><a align ="center" href="tables.php" class="btn"><i class="icon-pencil"></i>Go to sheets</a></p>
     <?php if($account_type == "Admin") {?> <p align="center"><a align ="center" href="new_class.php" class="btn"><i class="icon-plus"></i> Add a new Class</a></p> <?php } ?>
    <?php if($account_type == "Admin") {?>  <p align="center"><a align ="center" href="new_staff.php" class="btn"><i class="icon-plus"></i> Add a new Staff Member</a></p> <?php } ?>
     <?php if($account_type == "Admin") {?> <p align="center"><a align ="center" href="new_student.php" class="btn"><i class="icon-plus"></i> Add a new Student</a></p> <?php } ?>
    <?php if($account_type == "Admin") {?>  <p align="center"><a align ="center" href="new_subject.php" class="btn"><i class="icon-plus"></i> Add a new Subject</a></p> <?php } ?>
     <p align="center"><a align ="center" href="#class_selectDiv" data-toggle="modal" class="btn"><i class="icon-print"></i> Print Terminal Reports</a></p> 
     </div>


	<div id="class_selectDiv" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Select Class</h3>
        </div>
   <div class="modal-body">
  <form action="print.php" enctype="multipart/form-data" method="get" >
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
  Term:	<select name="select_term" id="select_term" class="span2">
        <option value="1st">1st</option>
        <option value="2nd">2nd</option>
        <option value="3rd">3rd</option>
        </select>
  Year: <select name="select_year" id="select_year"  class="span2">
  		<option value="2012">2012</option>
  		<option value="2013">2013</option>
        <option value="2014">2014</option>
  		</select> 
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
    <input type="submit" id="submit" name="submit" value="Preview Reports" class="btn btn-primary"/>
 </form>
  </div>
    </div>

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
