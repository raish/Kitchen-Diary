<?php
	echo "Hi";
 session_start();
 session_destroy();
 header('Location: main_login.php');
exit;
?>