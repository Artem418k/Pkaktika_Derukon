<?php
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
	$phone_number = filter_var(trim($_POST['phone_number']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
	$passpodtv = filter_var(trim($_POST['passpodtv']), FILTER_SANITIZE_STRING);
	$data_changes = 0;

	include 'database.php';
	$hash = $_COOKIE['user'];
            $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
            while( $row = mysqli_fetch_assoc($result) ) { 
                $idR = $row['id'];
                $nameR = $row['name'];
                $surnameR = $row['surname'];
                $phone_numberR = $row['phone_number'];
                $emailR = $row['email'];
                $passR = $row['pass'];
                }
	if(mb_strlen($name) != 0 ) {
		if(mb_strlen($name) < 2 || mb_strlen($name) > 70) {
		echo "<h1 align='center'>Неприпустима довжина імені,<br> будь ласка, введіть від 2 до 70 символів і повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
		}
		if ($nameR != $name) {
			$mysql->query("UPDATE `users` SET `name`= '$name' WHERE `id`= '$idR'");
			$data_changes = 1;	
		}
	} 
	if(mb_strlen($surname) != 0 ){
		if(mb_strlen($surname) < 2 || mb_strlen($surname) > 70) {
		echo "<h1 align='center'>Неприпустима довжина прізвища,<br> будь ласка, введіть від 2 до 70 символів і повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
		}
		if ($surnameR != $surname) {
			$mysql->query("UPDATE `users` SET `surname`= '$surname' WHERE `id`= '$idR'");
			$data_changes = 1;
		}
	}
	if(mb_strlen($phone_number) != 0 ){
		if(mb_strlen($phone_number) < 10 || mb_strlen($phone_number) > 15) {
		echo "<h1 align='center'>Неприпустима довжина номеру телефону,<br> будь ласка, введіть від 10 до 15 символів і повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
		}
		if ($phone_numberR != $phone_number) {
			$mysql->query("UPDATE `users` SET `phone_number`= '$phone_number' WHERE `id`= '$idR'");
			$data_changes = 1;
		}
	} 
	if(mb_strlen($email) != 0 ){
		if(mb_strlen($email) < 10 || mb_strlen($email) > 100) {
		echo "<h1 align='center'>Неприпустима довжина пошти,<br> будь ласка, введіть від 10 до 100 символів і спробуйте ще раз ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
		}
		if ($emailR != $email) {
			$mysql->query("UPDATE `users` SET `email`= '$email' WHERE `id`= '$idR'");
			$data_changes = 1;
		}
	} 
	if(mb_strlen($pass) != 0 ){
		if(mb_strlen($pass) < 4 || mb_strlen($pass) > 10) {
		echo "<h1 align='center'>Неприпустима довжина пароля,<br> будь ласка, введіть від 4 до 10 символів і повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();
		} else if(mb_strlen($passpodtv) < 4 || mb_strlen($passpodtv) > 10) {
		echo "<h1 align='center'>Неприпустима довжина пароля для підтвердження,<br> будь ласка, введіть від 4 до 10 символів і повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();	
		} else if(mb_strlen($pass) != mb_strlen($passpodtv)) {
		echo "<h1 align='center'>Повторний пароль введено не вірно,<br> будь ласка, повторіть спробу ";?><a href="/index.php">ще раз</a></h1><?php
		exit();		
		}
		$pass = md5($pass."dXa2cK9Mar2P4");
		if ($passR != $pass) {
			$mysql->query("UPDATE `users` SET `pass`= '$pass' WHERE `id`= '$idR'");
			$data_changes = 1;
		}
	}    
	if($data_changes == 1){
		echo "<h1 align='center'>Дані успішно змінено,<br> щоб повернутися в кабінет натисніть ";?><a href="/index.php">тут</a></h1><?php
		exit();	
	}

	$mysql->close();
	header('Location: /index.php');
?>