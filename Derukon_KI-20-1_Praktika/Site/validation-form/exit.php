<?php
	if (isset($_COOKIE['user'])){
	setcookie('user', $_COOKIE['user'], time() - 3600, "/");
	}
	header('Location: /index.php');
?>