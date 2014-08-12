<?php
session_start();
require_once 'config.php';
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Could not connect database");
mysql_select_db(DB_DATABASE, $con) or die("Could not select database");

$username=$_POST['username'];
$password=$_POST['password'];
mysql_query("INSERT INTO users(username,password) VALUES('$username','$password')");
header("location: main_login.php?remarks=success");
mysql_close($con);
?>