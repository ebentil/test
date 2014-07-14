<?php 

	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	?>
    
	<div class="span3">
    <h4>Subjects</h4>
    <!--<small class="text-warning"><a href="logout.php" class="btn-danger btn-mini">Log out</a></small>-->
    <table id="subjtable" width="410">
    <?php 
		$q2 = "SELECT * FROM subjects";
		$result2 = mysql_query($q2) or die (mysql_error());
		while($subjects = mysql_fetch_array($result2)) {
			$subjName = $subjects['subject_name'];
			$subjID = $subjects['subject_id'];
		echo "	 <tr>
    <td width='300'> ". $subjName . "</td>
    <td width='50'><small class='text-warning'><a href='#editModal' class='btn-success btn-mini' role=\"button\" class=\"btn\" data-toggle=\"modal\" onClick=\"fill_input('".$subjName."','".$subjID."')\"><i class=\"icon-edit\"></i>Edit</a></small></td>
	<td width='60'><small class='text-warning'><a href='#deleteModal' class='btn-danger btn-mini' role=\"button\" class=\"btn\" data-toggle=\"modal\" onClick=\"showMsg('".$subjName."','".$subjID."')\"><i class=\"icon-remove-circle\"></i>Delete</a></small></td>
  			</tr>";
		}
	?></table>
    </div>
	
	
	
