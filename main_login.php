<?php
	//Start session
	session_start();
?>
<html>
<body background="spices.jpg">
<form name="loginform" action="checklogin.php" method="post">
<table width="274" border="0" align="right" cellpadding="2" cellspacing="5">
  <tr>
    <td colspan="2">
		<!--the code bellow is used to display the message of the input validation-->
		 <?php
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) 
			{	
				echo '<ul class="err">';
				foreach($_SESSION['ERRMSG_ARR'] as $msg) 
				{
					echo '<li>',$msg,'</li>'; 
				}
				echo '</ul>';
				unset($_SESSION['ERRMSG_ARR']);
			}
		?>
	</td>
  </tr>
  <tr>
    <td width="116"><div align="right"><b>Username</b></div></td>
    <td width="177"><input name="username" type="text" /></td>
	<td><div align="right"><b>Password</b></div></td>
    <td><input name="password" type="password" /></td>
	<td><div align="right"></div></td>
    <td><input name="" type="submit" value="Sign in" /></td>
  </tr>
</table>
</form>
</br>
</br>
</br>
</br>
<form name="reg" action="checkregister.php" onsubmit="return validateForm()" method="post">
<table width="274" border="0" align="right" cellpadding="2" cellspacing="5">
  <tr>
    <td colspan="3">
		<div align="right">
		<?php 
			if (!isset($_GET['remarks'])) 
			{
					$remarks=""; 
			}
			else 
			{
				$remarks=$_GET['remarks']; 
			}
			if ($remarks=='success')
			{
				echo 'You have successfully registered.';
			}
			else
			{
				echo '<b>Complete the form below to register</b>';
			}
		?>	
	    </div></td>
  </tr>
 <tr>
    <td><div align="right"><b>Username:</b></div></td>
    <td><input type="text" name="username" /></td>
 </tr>
 <tr>
    <td><div align="right"><b>Password:</b></div></td>
    <td><input type="password" name="password" /></td>
 </tr>
  <tr>
    <td><div align="right"><b>Confirm Password:</b></div></td>
    <td><input type="password" name="copassword" /></td>
 </tr>
 <tr>
    <td><div align="right"></div></td>
    <td><input name="submit" type="submit" value="Register" /></td>
 </tr>
</table>
</form>
</body>
</html>
