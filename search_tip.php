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
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body background="redwood.jpg" style="color:white">
<?php
$searchErr = "";
$addtipErr = "";
$search = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["search"])) 
   {
     $searchErr = "Search Keyword is required";
   } 
   else 
   {
     $search = test_input($_POST["search"]);     
	}   
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Search Tip</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Search Keyword: <input type="text" name="search" value="<?php echo $search;?>">
   <span class="error"> <?php echo $searchErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>
<table>
	<?php
		error_reporting(0);
		require_once 'config.php';
		mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Error:".mysqlerror());
		mysql_select_db(DB_DATABASE);
		$search = mysql_real_escape_string($search);
		$result = mysql_query("SELECT * FROM tip WHERE tip_keyword = '$search' ");
		if(mysql_num_rows($result) == 0) // User not found. 
		{
			//echo 'None of the tips are related to your keyword';
		}
		else
		{
			while ($row = mysql_fetch_array($result))
			{?>
				<tr>
					<td><h3><i><?php echo $row['tip_description'];?></i></h3></td>
				</tr>
			<?php }
		}
	?>
</table>
</body>
</html>