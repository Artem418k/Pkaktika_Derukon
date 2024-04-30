<?php
	$replyIdSubComment = $_GET['id'];
   	$replySubComment = filter_var(trim($_POST['replySubComment']), FILTER_SANITIZE_STRING);
	$date = date('Y-m-d H:i:s');

	if(mb_strlen($replySubComment) < 1 || mb_strlen($replySubComment) > 250) {
		echo "<h1 align='center'>Неприпустима довжина коментаря,<br> будь ласка, введіть від 1 до 250 символів і спробуйте ";?><a href="replySubComment.php?id=<?=$edit_id?>">ще раз</a></h1><?php
		exit();
	}
	include 'database.php';
	$hash = $_COOKIE['user'];
    $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
    while( $row = mysqli_fetch_assoc($result) ) { 
        $idReplyUser = $row['id'];
    }

    $mysql->query("INSERT INTO `reply_comment` (`reply_comment`, `id_sub_comment`, `id_reply_user`, `date_reply`) VALUES('$replySubComment', '$replyIdSubComment', '$idReplyUser', '$date')");

	$mysql->close();
	header('Location: /comment.php');
?>