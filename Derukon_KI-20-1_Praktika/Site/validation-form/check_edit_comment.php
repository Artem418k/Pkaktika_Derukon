<?php
	$edit_id = $_GET['id'];
   	$comment = filter_var(trim($_POST['comment_edit']), FILTER_SANITIZE_STRING);
	$date = date('Y-m-d H:i:s');

	if(mb_strlen($comment) < 1 || mb_strlen($comment) > 250) {
		echo "<h1 align='center'>Неприпустима довжина коментаря,<br> будь ласка, введіть від 1 до 250 символів і спробуйте ";?><a href="edit_comment.php?id=<?=$edit_id?>">ще раз</a></h1><?php
		exit();
	}
	include 'database.php'; 

	$result = $mysql->query("SELECT * FROM `comments` WHERE `id`='$edit_id'");
    while( $row = mysqli_fetch_assoc($result) ) {
        $comment_user = $row['comment'];    
    }
	if ($comment_user != $comment) {
		$mysql->query("UPDATE `comments` SET `comment` = '$comment', `date_edit` = '$date'WHERE `id`= '$edit_id'");
	}   
	$mysql->close();
	header('Location: /comment.php');
?>