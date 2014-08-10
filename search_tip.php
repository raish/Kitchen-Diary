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
		mysql_connect("localhost","root","mysql") or die("Error:".mysqlerror());
		mysql_select_db("os");
		$search = mysql_real_escape_string($search);
		$result = mysql_query("SELECT * FROM tip WHERE tip_keyword = '$search' ");
		if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.
		{
			//echo 'None of the tips are related to your keyword';
		}
		else
		{
			while ($row = mysql_fetch_array($result))
			{?>
				<tr>
					<td><?php echo $row['tip_description'];?></td>
				</tr>
			<?php }
		}
	?>
</table>
</body>
</html>