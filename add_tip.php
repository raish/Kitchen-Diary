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
		mysql_connect("localhost","root","mysql") or die("Error:".mysqlerror());
		mysql_select_db("os");
		$comment = mysql_real_escape_string($comment);
		mysql_query("INSERT INTO tip(tip_keyword,tip_description) VALUES('$keyword','$comment')");
		mysql_close($con);
	?>
</table>
</body>
</html>