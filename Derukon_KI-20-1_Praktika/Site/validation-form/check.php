<?php
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
	$phone_number = filter_var(trim($_POST['phone_number']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
	$passpodtv = filter_var(trim($_POST['passpodtv']), FILTER_SANITIZE_STRING);

	if(mb_strlen($name) < 2 || mb_strlen($name) > 70) {
		echo "<h1 align='center'>Неприпустима довжина імені,<br> будь ласка, введіть від 2 до 70 символів і повторіть спробу ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();
	} else if(mb_strlen($surname) < 2 || mb_strlen($surname) > 70) {
		echo "<h1 align='center'>Неприпустима довжина прізвища,<br> будь ласка, введіть від 2 до 70 символів і повторіть спробу ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();
	} else if(mb_strlen($phone_number) < 10 || mb_strlen($phone_number) > 15) {
		echo "<h1 align='center'>Неприпустима довжина номеру телефону,<br> будь ласка, введіть від 10 до 15 символів і повторіть спробу ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();
	} else if(mb_strlen($email) < 10 || mb_strlen($email) > 100) {
		echo "<h1 align='center'>Неприпустима довжина пошти,<br> будь ласка, введіть від 10 до 100 символів і спробуйте ще раз ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();
	} else if(mb_strlen($pass) < 4 || mb_strlen($pass) > 10) {
		echo "<h1 align='center'>Неприпустима довжина пароля,<br> будь ласка, введіть від 4 до 10 символів і повторіть спробу ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();
	} else if(mb_strlen($passpodtv) < 4 || mb_strlen($passpodtv) > 10) {
		echo "<h1 align='center'>Неприпустима довжина повторного пароля,<br> будь ласка, введіть від 4 до 10 символів і повторіть спробу ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();	
	} else if(mb_strlen($pass) != mb_strlen($passpodtv)) {
		echo "<h1 align='center'>Повторний пароль введено не вірно,<br> будь ласка, повторіть спробу ";?><a href="/reg.php">ще раз</a></h1><?php
		exit();		
	}

	$hash = md5($name . time());

	$server = $_SERVER['HTTP_HOST'];

	//Отправляем письмо подтверждения почты
	mail($email, 'Підтвердження електронної адреси', 'Щоб підтвердити Email, перейдіть за посиланням: http://' . substr($server, strrpos($server, '/')) . '/validation-form/check_hash.php?hash=' . $hash . '', 'From: kirichek705@gmail.com');
    
    $pass = md5($pass."dXa2cK9Mar2P4");
        
        // Добавление пользователя в БД
	include 'database.php';
	$mysql->query("INSERT INTO `users` (`name`, `surname`, `phone_number`, `email`, `pass`, `hash`, `email_confirmed`) VALUES('$name', '$surname', '$phone_number', '$email', '$pass', '$hash', '1')");

	echo "<h1 align='center'>Ви успішно зареєструвалися,<br> чщоб увійти до свого облікового запису потрібно підтвердити пошту, щоб вийти - натисніть ";?><a href="/reg.php">тут</a></h1><?php
		
	$mysql->close();
?>