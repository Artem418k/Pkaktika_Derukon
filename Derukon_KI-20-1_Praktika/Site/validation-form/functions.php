<?php
  function can_upload($file){
    // если имя пустое, значит файл не выбран
    if($file['name'] == '')
        return 'Ви не вибрали файл.';
    
    /* если размер файла 0, значит его не пропустили настройки 
    сервера из-за того, что он слишком большой */
    if($file['size'] == 0)
        return 'Файл занадто великий.';
    
    // получаем расширение файла
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // объявим массив допустимых расширений
    $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
    
    // если расширение не входит в список допустимых - return
    if(!in_array($extension, $types))
        return 'Неприпустимий тип файлу.';
    
    return true;
  }
  
function make_upload($file){   
    // формируем уникальное имя картинки: случайное число и name
    $name = uniqid() . '_' . $file['name']; // добавляем уникальный идентификатор перед именем файла
    copy($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/photo/' . $name);

    include 'database.php';

    $hash = $_COOKIE['user'];
    $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
    while( $row = mysqli_fetch_assoc($result) ) { 
        $id_user = $row['id'];
    }

    $mysql->query("UPDATE `users` SET `avatar` = '/photo/$name' WHERE `id`= '$id_user'");
    $mysql->close();
}ysql->close();
  }
?>
