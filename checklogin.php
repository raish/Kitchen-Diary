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
<?php
	ob_start();
	session_start();
	require_once 'config.php';
	$errmsg_arr = array();
	$errflag = false;
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	mysql_select_db(DB_DATABASE, $conn);
	// username and password sent from form 
	$username=$_POST['username']; 
	$password=$_POST['password']; 
	$username = stripslashes($username);
	$username = mysql_real_escape_string($username);
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