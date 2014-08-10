<!DOCTYPE HTML> 
<html>
<head>
<script language="javascript" style="font-color:white">
		function addRow(tableID) 
		{ 
			var table = document.getElementById(tableID); 
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount); 
			var cell1 = row.insertCell(0);
			var element1 = document.createElement("input");
			element1.type = "text";
			element1.name="txtbox[]";
			cell1.appendChild(element1);             
			var cell2 = row.insertCell(1);
			var element2 = document.createElement("input");
			element2.type = "text";
			element2.name = "txtbox[]";
			cell2.appendChild(element2); 
		}   

		function addingredients() 	
		{
			var table = document.getElementById("dataTable");
			var iptext = document.getElementById("ingtext");
			for (var i = 1, row; row = table.rows[i]; i++) 
			{
				for (var j = 0, col; col = row.cells[j]; j++) 
				{
					if(i == 1 && j ==0)
					{
						iptext.value = col.getElementsByTagName('input')[0].value;
					}
					else
					{
						iptext.value = iptext.value + "," + col.getElementsByTagName('input')[0].value;
					}				    
				}  
			}
			return true;
		}				
	</script>
</head>
<body background="redwood.jpg" style="color:white">
<?php
$addnameErr = "";
$addshareErr= "";
$addmethodErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 	if (empty($_POST["recipename"])) 
	{
		$addnameErr = "Enter recipe name";
	} 
	else 
	{
		$recipename = test_input($_POST["recipename"]);
	}
	
	if (empty($_POST["share"])) {
		$share = "";
		$addshareErr = "Enter choice";
	} 
	else {
		$share = test_input($_POST["share"]);
	}
	
	if (empty($_POST["method"])) 
	{
		$method = "";
		$addmethodErr = "Enter method";
	} 
	else 
	{
		$method = test_input($_POST["method"]);
	}
	if (empty($_POST["ingtext"])) 
	{
		$ingtext = "";
		$addmethodErr = "Enter ingtext";
	} 
	else 
	{
		$ingtext = test_input($_POST["ingtext"]);
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Add Recipe</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
Recipe Name <input type="text" name="recipename" value="">
			<span class="error"> <?php echo $addnameErr;?></span><br/><br/>
<input type="text" name="ingtext" id="ingtext" style="display:none" />				
<input type="button" value="Add Ingredients" onclick="addRow('dataTable')" />
						<table id="dataTable" width="350px" border="1">
							<tr>
								<th>Ingredient Name</th>
								<th>Quantity</th>
							</tr>
							<tr>
								<td> <input type="text" name="txt1[]"/> </td>
								<td> <input type="text" name="txt2[]"/> </td>
							</tr>
						</table>
<h4>Method</h4>
			<textarea name="method" rows="6" cols="40"></textarea>
			<span class="error"> <?php echo $addmethodErr;?></span></br></br>
Share Publicly? <input type="radio" name="share" value="y">Yes
						<input type="radio" name="share" value="n">No
						<span class="error"> <?php echo $addshareErr;?></span></br></br>
			<input type="submit" name="submit" value="Add Recipe" onclick="addingredients()" /> 

</form>
<table>
	<?php
		session_start();
		error_reporting(0);
		mysql_connect("localhost","root","mysql") or die("Error:".mysqlerror());
		mysql_select_db("os");
		$username = $_SESSION['sess_username'];
		$result = mysql_query("SELECT MAX(recipe_id) as max_recipe_id FROM recipe WHERE user_id = '$username' ");
		$row = mysql_fetch_array($result);
		$max_row = $row['max_recipe_id']+1;
		$recipename = mysql_real_escape_string($recipename);
		$share =  mysql_real_escape_string($share);
		$method = mysql_real_escape_string($method);
		$ingtext = mysql_real_escape_string($ingtext);
		$pieces = explode(",", $ingtext);
		$n = count($pieces);
		if($n > 0 && $recipename != "")
		{		
			mysql_query("INSERT INTO recipe(recipe_name,recipe_desc,shared,user_id) VALUES('$recipename','$method','$share','$username')");
			for ($i=0;$i<$n;$i=$i+2)
			{
				$j=$i+1;
				mysql_query("INSERT INTO ingredients(ingredient_name,ingredient_quantity,recipe_id) VALUES('$pieces[$i]','$pieces[$j]','$max_row')");
			}
		}
		mysql_close($con);
	?>
</table>
</body>
</html>