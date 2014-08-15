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
			$search = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
			   if (empty($_POST["search"])) 
			   {
					$searchErr = "Search Keyword is required";
			   } 
			   else 
			   {
					$search = test_input($_POST["search"]);     
				}   
			}
			function test_input($data) 
			{
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>

		<h2>Search Recipe</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			Search Keyword: <input type="text" name="search" value="<?php echo $search;?>">
			<span class="error"> <?php echo $searchErr;?></span><br><br>
			<input type="submit" name="submit" value="Submit"><br><br>
		</form>
		<table>
			<?php
				error_reporting(0);
				require_once 'config.php';
				mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Error:".mysqlerror());
				mysql_select_db(DB_DATABASE);
				$username = $_SESSION['sess_username'];
				$search = mysql_real_escape_string($search);
				$result = mysql_query("SELECT * FROM recipe WHERE recipe_name = '$search' and shared = 'y' or username = '$username'");
				if(mysql_num_rows($result) == 0) // User not found.
				{
					if ($search != "")
					{
						echo 'None of the recipes are related to your keyword';
					}
				}
				else
				{
					while ($row = mysql_fetch_array($result))
					{?>
						<tr>
							<h3><li id ="li_srchrectab" name="recipename"><a href="#" onClick="window.open('recipe_details.php?recipename=<?php echo $row['recipe_name']; ?>','recipedetails','resizable,height=650,width=500');return false;"><?php echo $row['recipe_name'];?></a></li></h3>
						</tr>
					<?php }
				}
			?>
		</table>
	</body>
</html>