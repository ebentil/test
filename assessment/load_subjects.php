Subject:
  <select name="select_subject" size="1" id="select_subject" onchange="load_sheet()">
    <?php //populating it with the registered subjects
	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	$theClass = $_GET['class'];
	$q = mysql_query("SELECT subjects FROM classes WHERE class_id = '$theClass'");
	
	
	
	while ($qArray = mysql_fetch_array($q)) {
		
		$qSubjects = $qArray['subjects'];
		$qSubArray = explode(",", $qSubjects);
		
		for ($i=0; $i < count($qSubArray); $i++) {
			$theSubjId = $qSubArray[$i];
			$q2 = mysql_query("SELECT subject_name FROM subjects WHERE subject_id = '$theSubjId'");
			$q2Array = mysql_fetch_array($q2);
			echo "<option value='".$theSubjId."'>".$q2Array['subject_name']."</option>";
			
			
		}
	}
	
?>
  </select>