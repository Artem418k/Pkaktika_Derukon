<?php
	include 'database.php';
    $hash = $_COOKIE['user'];
    $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
    while( $row = mysqli_fetch_assoc($result) ) { 
        $avatarPath = $row['avatar'];
        $userId = $row['id'];
    }
    if ($avatarPath != ''){
        unlink($_SERVER['DOCUMENT_ROOT'] . $avatarPath);
        $mysql->query("UPDATE `users` SET `avatar` = NULL WHERE `id` = '$userId'");
    }
    
	$mysql->close();
	header('Location: /index.php');
?>