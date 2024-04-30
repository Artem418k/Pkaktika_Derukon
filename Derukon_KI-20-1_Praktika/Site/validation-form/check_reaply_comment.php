<?php
	$comment_id = $_GET['id'];
   	$reply_comment = filter_var(trim($_POST['reply_comment']), FILTER_SANITIZE_STRING);
	$date = date('Y-m-d H:i:s');

	if(mb_strlen($reply_comment) < 1 || mb_strlen($reply_comment) > 250) {
		echo "<h1 align='center'>Неприпустима довжина коментаря,<br> будь ласка, введіть від 1 до 250 символів і спробуйте ";?><a href="reply_comment.php?id=<?=$edit_id?>">ще раз</a></h1><?php
		exit();
	}
	include 'database.php';
	$hash = $_COOKIE['user'];
    $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
    while( $row = mysqli_fetch_assoc($result) ) { 
        $id_reply_user = $row['id'];
    }
    $mysql->query("INSERT INTO `reply_comment` (`reply_comment`, `id_comment`, `id_reply_user`, `date_reply`) VALUES('$reply_comment', '$comment_id', '$id_reply_user', '$date')");
	$mysql->close();
	header('Location: /comment.php');
?>