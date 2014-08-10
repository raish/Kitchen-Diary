<!DOCTYPE HTML> 
<html>
<head></head>
<body background="redwood.jpg" style="color:white">
	<?php
		session_start();
		error_reporting(0);
		require_once 'config.php';
		mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Error:".mysqlerror());
		mysql_select_db(DB_DATABASE);
		echo "<table>";
		$username = "user1";
		$recipename=$_GET['recipename'];
		echo "<p align=center><i> <font face=Bookman Old style size='16pt'>$recipename</font></i></p>";
		$result = mysql_query("SELECT * FROM recipe WHERE recipe_name = '$recipename' ");
		$row = mysql_fetch_array($result);
		$recipeid = $row['recipe_id'];
		echo "<p align=left><i> <font face=Bookman Old style  size='5pt'>Ingredients</font></i></p>";
		$result1 = mysql_query("SELECT ingredient_name,ingredient_quantity FROM ingredients WHERE recipe_id = '$recipeid' ");
		while ($row1 = mysql_fetch_array($result1))
		{
			echo "<tr>";
			echo "<td>" . $row1['ingredient_name'] . "</td>";
			echo "<td>" . $row1['ingredient_quantity'] . "</td>";
			echo "</tr>";
		}	
		echo "</table>";
		echo "<p align=left><i> <font face=Bookman Old style  size='5pt'>Procedure</font></i></p>";
		echo $row['recipe_desc']; 
		mysql_close($con);
	?>
</body>
</html>

