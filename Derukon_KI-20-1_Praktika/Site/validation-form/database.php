<?php
	$mysql = new mysqli('127.0.0.1', 'root', 'root', 'praktika-html');
	if ($mysql->connect_error) {
    	echo "<h1 align='center'>Connection failed: " . $mysql->connect_error?><br> Будь ласка, спробуйте <a href="/comment.php">ще раз</a></h1><?php
    	exit();
	}
?>