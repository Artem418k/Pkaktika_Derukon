<?php
    $idDeleteSubComment = $_GET['idDeleteSubComment'];
	include 'database.php';

	$result = $mysql->query("SELECT * FROM `reply_comment` WHERE `id_reply` = '$idDeleteSubComment'");
	$sql = "SELECT id_reply, reply_comment, id_comment, id_sub_comment, id_reply_user, date_reply, edit_date_reply FROM reply_comment";
	$sql = "DELETE FROM `reply_comment` WHERE `reply_comment`.`id_reply` = $idDeleteSubComment";

	$result = $mysql->query($sql);
	$mysql->close();
	
	header('Location: /comment.php');
?>