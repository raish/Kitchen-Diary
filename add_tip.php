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
</head>
<body background="redwood.jpg" style="color:white">
<?php
$addtipErr = "";
$addtip = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["comment"])) 
   {
		$comment = "";
		$addtipErr = "Enter description to add a tip";
   } 
   else 
   {
		$comment = test_input($_POST["comment"]);
   }  
    
	if (empty($_POST["keyword"])) 
	{
		$keyword = "";
	} 
	else 
	{
     $keyword = test_input($_POST["keyword"]);
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Add Tip</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
Keyword    : <input type="text" name="keyword" value=""><br><br>
Description: <textarea name="comment" rows="5" cols="40"> </textarea>
		<span class="error"> <?php echo $addtipErr;?></span>
		<br><br>
		<input type="submit" name="submit" value="Add Tip"> 
</form>
<table>
	<?php
		error_reporting(0);
		require_once 'config.php';
		mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Error:".mysqlerror());
		mysql_select_db(DB_DATABASE);
		$comment = mysql_real_escape_string($comment);
		mysql_query("INSERT INTO tip(tip_keyword,tip_description) VALUES('$keyword','$comment')");
		mysql_close($con);
	?>
</table>
</body>
</html>