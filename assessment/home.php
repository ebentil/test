<?php
require_once("includes/functions.php"); 
$connection=mysql_connect("localhost","ebo1", "abcd") or die ("cannot connect");
mysql_select_db("assessment") or die ("cannot select DB");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body><a href="home.php">Create a new Assessment Sheet</a>

<table width="400" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2">Create a Assessment Sheet</td>
  </tr>
  <form action="home.php" method="post" enctype="multipart/form-data" onsubmit="check_empty()" name="form1">
  <tr>
    <td width="68">Class</td>
    <td width="326">
    </td>
  </tr>
  <tr>
    <td>Subjects</td>
    <td>
   
</td>
  </tr>
  <tr>
    <td colspan="2"> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
      <input type="submit" id="submit" name="submit" />
      &nbsp;</td>
    </tr>
  </form>
</table>
</body>
</html>
