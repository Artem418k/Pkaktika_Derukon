<?php
    $id = $_GET['idReplyComment'];
	include 'database.php';

	$result = $mysql->query("SELECT * FROM `reply_comment` WHERE `id_reply` = '$id'");
	$sql = "SELECT id_reply, reply_comment, id_comment, id_sub_comment, id_reply_user, date_reply, edit_date_reply FROM reply_comment";
	$sql = "DELETE FROM `reply_comment` WHERE `reply_comment`.`id_reply` = $id";
	$result = $mysql->query($sql);
	$mysql->close();

	include 'database.php';

	$result = $mysql->query("SELECT * FROM `reply_comment` WHERE `id_sub_comment` = '$id'");
	$sql = "SELECT id_reply, reply_comment, id_comment, id_sub_comment, id_reply_user, date_reply, edit_date_reply FROM reply_comment";
	$sql = "DELETE FROM `reply_comment` WHERE `reply_comment`.`id_sub_comment` = $id";
	
	$result = $mysql->query($sql);
	$mysql->close();
	
	header('Location: /comment.php');
?>