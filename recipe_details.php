<!-- ********************************************************************************************
 * Copyright (C) 2014 Shoma Rai
 *
 * This program is free software: you can redistribute it and/or modify it under 
 * the terms of the GNU General Public License as published by the Free Software Foundation, 
 * either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. 
 * If not, see http://www.gnu.org/licenses/.
 *
 *  ******************************************************************************************/ -->
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
		</br></br>
		<form action="main_login.php" align=right>
			<input type="submit" name="submit" value="OK" onclick="window.close()">
		</form>
	</body>
</html>

