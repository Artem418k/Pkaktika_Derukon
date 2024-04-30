<?php 
 switch($location){
    case 'kabinet':
        $title = 'Особистий кабінет';
        break;
    case 'comment':
        $title = 'Форум';
        break;
    case 'index':
        $title = 'Форма авторизації';
        break;
    case 'reg':
        $title = 'Форма реєстрації';
        break;
    case 'edit_reply_for_comment':
        $title = 'Редагувати коментар';
        break;
    case 'edit_sub_comment':
        $title = 'Редагувати підкоментар';
        break;
    case 'loading':
        $title = 'Завантажити зображення';
        break;
    case 'reply_comment':
        $title = 'Відповісти на коментар';
        break;
    case 'reply_sub_comment':
        $title = 'Відповісти на підкоментар';
        break;
    case 'edit_comment':
        $title = 'Редагувати коментар';
        break;  
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title><?=$title?></title>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/navigation.css">
<style>
body { background: url(/photo/grad1.jpg); 
        background-attachment: fixed;}
</style>
</head>