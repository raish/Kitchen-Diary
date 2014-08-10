<?php
ob_start();
session_start();

require_once 'config.php';
$errmsg_arr = array();
$errflag = false;
$conn = mysql_connect('localhost', 'root', 'mysql');
mysql_select_db('os', $conn);

// username and password sent from form 
$username=$_POST['username']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
//$password = stripslashes($password);
$username = mysql_real_escape_string($username);
//$password = mysql_real_escape_string($password);

if($username == '') 
{
	$errmsg_arr[] = 'Username missing';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}

//If there are input validations, redirect back to the login form
if($errflag) 
{
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: main_login.php");
	exit();
}

$query = "SELECT * FROM users WHERE username = '$username';";
 
$result = mysql_query($query);
 
if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.
{
	$errmsg_arr[] = 'user name not found';
	$errflag = true;
}
else
{
	$userData = mysql_fetch_array($result, MYSQL_ASSOC);
	if ($password != $userData['password'])
	{
		$errmsg_arr[] = 'passwords dont match';
		$errflag = true;		
	}
	else
	{
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $userData['uid'];
		$_SESSION['sess_username'] = $userData['username'];
		session_write_close();
		header('Location: indexbook.php');
		exit();
	}
}
if($errflag) 
{
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: main_login.php");
	exit();
}
?>