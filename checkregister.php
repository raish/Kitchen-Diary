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