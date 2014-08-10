<?php
session_start();
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "mysql";
$mysql_database = "os";

$con = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $con) or die("Could not select database");

$username=$_POST['username'];
$password=$_POST['password'];
mysql_query("INSERT INTO users(username,password) VALUES('$username','$password')");
header("location: main_login.php?remarks=success");
mysql_close($con);
?>