<?php
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

	if ($email == '') {
		echo "<h1 align='center'>Ви не ввели пошту, повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
	} elseif ($pass == '') {
		echo "<h1 align='center'>Ви не ввели пароль, повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
	}
	else {
	$pass = md5($pass."dXa2cK9Mar2P4");

	include 'database.php';

	$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");
	$user = $result->fetch_assoc();
	if($user == '') {
		$mysql->close();
		echo "<h1 align='center'>Такого користувача не знайдено, перевірте дані та "?><a href="/index.php">введіть ще раз</a></h1><?php
		exit();
	} 
	
	$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");
	while( $row = mysqli_fetch_assoc($result) ) { 
            if ($row['email_confirmed'] == 0) {
            	$hash = $row['hash'];
            	setcookie('user', $user['hash'], time() + 3600, "/");
                } else {
            	$mysql->close();
               echo "<h1 align='center'>Ви не підтвердили пошту,<br> без підтвердження увійти не вийде.<br> Щоб повернутися назад, натисніть "?><a href="/index.php">сюди</a></h1><?php
               exit();
			}
        }

	$mysql->close();

	header('Location: /index.php');
	}
?>