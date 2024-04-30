<?php
  function can_upload($file){
	// если имя пустое, значит файл не выбран
    if($file['name'] == '')
		return 'Ви не вибрали файл.';
	
	/* если размер файла 0, значит его не пропустили настройки 
	сервера из-за того, что он слишком большой */
	if($file['size'] == 0)
		return 'Файл занадто великий.';
	
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// объявим массив допустимых расширений
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
	
	// если расширение не входит в список допустимых - return
	if(!in_array($mime, $types))
		return 'Неприпустимий тип файлу.';
	
	return true;
  }
  
  function make_upload($file){	
	// формируем уникальное имя картинки: случайное число и name
	$name = mt_rand(0, 10000) . $file['name'];
	copy($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/photo/' . $name);

	include 'database.php';

	$hash = $_COOKIE['user'];
    $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
    while( $row = mysqli_fetch_assoc($result) ) { 
        $id_user = $row['id'];
		}

	$mysql->query("UPDATE `users` SET `avatar` = '/photo/$name' WHERE `id`= '$id_user'");
	$mysql->close();
  }
?>