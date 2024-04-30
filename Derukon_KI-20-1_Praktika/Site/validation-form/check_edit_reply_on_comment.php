<?php
	$edit_id = $_GET['id'];
   	$comment = filter_var(trim($_POST['comment_edit']), FILTER_SANITIZE_STRING);
	$date = date('Y-m-d H:i:s');

	if(mb_strlen($comment) < 1 || mb_strlen($comment) > 250) {
		echo "<h1 align='center'>Неприпустима довжина коментаря,<br> будь ласка, введіть від 1 до 250 символів і спробуйте ";?><a href="edit_comment.php?replyOnCommentId=<?=$edit_id?>">ще раз</a></h1><?php
		exit();
	}
	include 'database.php'; 

	$result = $mysql->query("SELECT * FROM `reply_comment` WHERE `id_reply`='$edit_id'");
    while( $row = mysqli_fetch_assoc($result) ) {
        $comment_user = $row['reply_comment'];    
    }
	if ($comment_user != $comment) {
		$mysql->query("UPDATE `reply_comment` SET `reply_comment` = '$comment', `edit_date_reply` = '$date' WHERE `id_reply`= '$edit_id'");
	}   
	$mysql->close();
	header('Location: /comment.php');
?>