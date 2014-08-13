<?php
/* Copyright (C) 2014 Shoma Rai 
 This program is free software.you can redistribute it or modify it under the terms of the GNU General Public License as published by the Free Software */
 ?>
<html>
    <head>
		<title>Kitchen Diary</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link type="text/css" href="main.css" rel="stylesheet" media="screen" /> 
		<script type="text/javascript">
		function tab(tab) 
		{
			document.getElementById('addrectab').style.display = 'none';
			document.getElementById('srchtab').style.display = 'none';
			document.getElementById('addtiptab').style.display = 'none';
			document.getElementById('srchtiptab').style.display = 'none';
			document.getElementById('askfriend').style.display = 'none';
			document.getElementById('li_addrectab').setAttribute("class", "");
			document.getElementById('li_srchtab').setAttribute("class", "");
			document.getElementById('li_addtiptab').setAttribute("class", "");
			document.getElementById('li_srchtiptab').setAttribute("class", "");
			document.getElementById('li_askfriend').setAttribute("class", "");
			document.getElementById(tab).style.display = 'block';
			document.getElementById('li_'+tab).setAttribute("class", "active");
		}
		function LoadAddRecipe() 
		{
			var iframeobj = document.getElementById("kitchenframe");
			//alert(iframeobj);
			iframeobj.src= "add_recipe.php";
			iframeobj.height = "650";
			iframeobj.width = "540";
		}
		function LoadSearchRecipe() 
		{
			var iframeobj = document.getElementById("kitchenframe");
			//alert(iframeobj);
			iframeobj.src= "search_recipe.php";
			iframeobj.height = "550";
			iframeobj.width = "540";
		}	
		function LoadAddTip() 
		{
			var iframeobj = document.getElementById("kitchenframe");
			//alert(iframeobj);
			iframeobj.src= "add_tip.php";
			iframeobj.height = "600";
			iframeobj.width = "540";
		}		
		function LoadSearchTip() 
		{
			var iframeobj = document.getElementById("kitchenframe");
			//alert(iframeobj);
			iframeobj.src= "search_tip.php";
			iframeobj.height = "600";
			iframeobj.width = "540";
		}
		function LoadShare() 
		{
			var iframeobj = document.getElementById("kitchenframe");
			//alert(iframeobj);
			iframeobj.src= "share.php";
			iframeobj.height = "200";
			iframeobj.width = "350";
		}
		
		function AddRecipeBookPages()
		{
			alert("Loading pages");
		}
		</script>
	</head>
	<body background='brownbackground.jpg'>
		<div id="nav">
			<div id="nav_wrapper">
				<ul id="navmenu">
					<li><a href="#">Recipes</a><span class="darrow">&#9660;</span>
						<ul class="sub1">
							<li id ="li_addrectab" onclick="tab('addrectab')">
								<!--<a href="#" onClick="window.open('add_recipe.php','addrecipe','resizable,height=650,width=500');return false;">Add Recipe</a>-->
								<a href="#" onClick="LoadAddRecipe()">Add Recipe</a>
							</li>
							<li id ="li_srchtab" onclick="tab('srchtab')">
							<!--<a href="#" onClick="window.open('search_recipe.php','searchrecipe','resizable,height=650,width=500');return false;">Search Recipe</a></li>-->
							<a href="#" onClick="LoadSearchRecipe()">Search Recipe</a></li>
						</ul>	
					</li>
					<li><a href="#">Cooking Tips</a><span class="darrow">&#9660;</span>
						<ul class="sub1">
						<li id ="li_addtiptab" onclick="tab('addtiptab')">
						<!--<a href="#" onClick="window.open('add_tip.php','addtip','resizable,height=300,width=500');return false;">Add Tip</a></li>-->
						<a href="#" onClick="LoadAddTip()">Add Tip</a></li>
						<!--<li id ="li_srchtiptab" onclick="tab('srchtiptab')"><a href="#" onClick="window.open('search_tip.php','searchtip','resizable,height=300,width=500');return false;">Search Tip</a></li>-->
						<li id ="li_srchtiptab" onclick="tab('srchtiptab')"><a href="#" onClick="LoadSearchTip()">Search Tip</a></li>
						</ul>	
					</li>
					<li id ="li_askfriend" onclick="tab('askfriend')"><a href="#" onClick="LoadShare()">Social</a></li>
				</ul></br>
			</div>
			<div id="Content_Area"></div>
		</div>
		<div id="book">
			<canvas id="pageflip-canvas"></canvas>
			<div id="pages">
	<?php 
		session_start();
		require_once 'config.php';
		error_reporting(0);
		mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Error:".mysqlerror());
		mysql_select_db(DB_DATABASE);
		$username = $_SESSION['sess_username'];
		$result = mysql_query("SELECT * FROM recipe WHERE username ='$username'");
		if(mysql_num_rows($result) != 0) // User not found.
		{
			while ($row = mysql_fetch_array($result))
			{ 
				echo "<section>";
				echo "<div>";
				$recipe_id = $row['recipe_id'];	
				echo "<h2><i><u>".$row['recipe_name']."</u></i></h2>";
				//echo "<img src='page_img.png' alt=".$row['recipe_name'].">";
				$result1 = mysql_query("SELECT ingredient_name,ingredient_quantity FROM ingredients WHERE recipe_id = '$recipe_id' ");
				if(mysql_num_rows($result1) != 0) 
				{
					echo "<p><b>Ingredients</b></br>";
					while ($row1 = mysql_fetch_array($result1))
					{
						echo $row1['ingredient_name'].":".$row1['ingredient_quantity']."</br>";
					}	
					echo "</p>";
					echo "<p><b>Preparation</b></br>";
					echo $row['recipe_desc']."</br>";
				}
				echo "</div>";
				echo "</section>";
					
			} 
		}
	?>
			</div>
		</div>
		<iframe style ="position:absolute; right: 800px; top: 130px;" id="kitchenframe" height="500px" width="500px" frameborder ="0" src="">
			<p>Your browser does not support iframes.</p>
		</iframe>
		<?php
			function Logoutfunc()
			{
				echo "Logging out";
			}
		?>
		<div style ="position:absolute; left: 20px; top: 100px;">
			<form action="main_login.php" stylealign=left><input type="submit" value="Log Out"></form>
		</div>		
		<div style ="position:absolute; left: 600px; top: 600px;">
		<button type="button" id="button-prev1" onclick="javascript:BackPage();">Previous</button>
		<button type="button" id="button-next1" onclick="javascript:FrontPage();">Next</button>
		</div>
		<script type="text/javascript" src="pageflip.js"></script>
	</body>	
<html>
