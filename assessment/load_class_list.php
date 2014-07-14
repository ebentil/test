<?php 

	$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
	mysql_select_db("assessment") or die ("cannot select DB");
	?>

<div class="span3">
    <h5>Registered Classes</h5>
    <table id="classtable" width="210">
    <?php
	$q2 = "SELECT * FROM classes";
	$result2 = mysql_query($q2) or die (mysql_error());
	while($classes = mysql_fetch_array($result2)) {
		$className = $classes['class_name'];
		$classID = $classes['class_id'];
		$classSubjIDs = $classes['subjects'];
		echo "	 <tr>
    <td width='100'> <li>". $className . "</li></td>";
	}
	?>
	</table>
    </div>
	<!--
	
    <td width='50'><small class='text-warning'><a href='#editModal' class='btn-success btn-mini' role=\"button\" class=\"btn\" data-toggle=\"modal\" onClick=\"fill_input('".$className."','".$classID."')\"><i class=\"icon-edit\"></i>Edit</a></small></td>
	<td width='60'><small class='text-warning'><a href='#deleteModal' class='btn-danger btn-mini' role=\"button\" class=\"btn\" data-toggle=\"modal\" onClick=\"showMsg('".$className."','".$classID."')\"><i class=\"icon-remove-circle\"></i>Delete</a></small></td>
  			</tr>";
		-->
	