<?php $location  = 'edit_reply_for_comment'; 
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/navbar.php'; ?>

    <div class="container mt-4">

        <?php if (!isset($_COOKIE['user'])): ?>
        <meta http-equiv="refresh" content="0; /index.php">
        <?php else: 
            include 'database.php';
            $hash = $_COOKIE['user'];
            $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
            while( $row = mysqli_fetch_assoc($result) ) { 
                $nameC = $row['name'];
            }
            
            $idForEditReplyOnComment = $_GET['replyOnCommentId'];
            $result_edit = $mysql->query("SELECT * FROM `reply_comment` WHERE `id_reply`='$idForEditReplyOnComment'");
            while( $row_edit = mysqli_fetch_assoc($result_edit) ) { 
                $edit_comment = $row_edit['reply_comment'];
                $idCommentForReplyComEdit = $row_edit['id_comment'];
            }
            
            $resultEditReplyCommentar = $mysql->query("SELECT * FROM `comments` WHERE `id`='$idCommentForReplyComEdit'");
            while( $row = mysqli_fetch_assoc($resultEditReplyCommentar) ) { 
                $edit_id = $row['id'];
            }
        ?>

        <div class="row">
            <div class="col" align="center">
                <h1>Редагувати коментар</h1>
                <form action="check_edit_reply_on_comment.php?id=<?=$idForEditReplyOnComment?>" method="post">
                <div class="mb-3">
                <label for="comment_edit" class="form-label">Коментар буде від Вашого імені: <?=$nameC?></label>  
                <textarea class="form-control" name="comment_edit" id="comment_edit" rows="3"><?=$edit_comment?></textarea><br>
                <button class="btn btn-info" type="submit">Відредагувати коментар</button>                  
                </form>
                <a href="/comment.php" class="btn btn-warning" >Скасувати редагування</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
            
        <?php       
        $sql = "SELECT * FROM comments ORDER BY id DESC"; 
        $result = $mysql->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user_id = $row['user_id'];
                $result2 = $mysql->query("SELECT * FROM `users` WHERE `id`='$user_id'");
                while( $row2 = mysqli_fetch_assoc($result2) ) {
                    $name  = $row2['name']; 
                } ?>
                <br><br>
                <table border="0" align="center" width="75%" cellpadding="7" bordercolor="Black">
                <?php
                if ($row["date_edit"] != ''){ ?>
                    <td bgcolor='#0dd3de' align='left'>Ім'я: <?=$name?></td>
                    <td bgcolor='#0dd3de' align='right'>Час: <?=$row["date_c"]?> (Ред.: <?=$row["date_edit"]?>)</td><tr>
                <?php } else { ?>
                    <td bgcolor='#0dd3de' align='left'>Ім'я: <?=$name?></td>
                    <td bgcolor='#0dd3de' align='right'>Час: <?=$row["date_c"]?></td><tr>
                <?php } ?>
                </table>
                <table border="0" align="center" width="75%" cellpadding="15" bordercolor="Black">
                <?php if ($edit_id == $row["id"]){ ?>
                    <td bgcolor='#adadad'><?=$row["comment"]?></td><tr>
                <?php } else { ?>
                    <td bgcolor='white'><?=$row["comment"]?></td><tr>
                <?php } ?>
                </table>
                <?php                
                $hash = $_COOKIE['user'];
                $result3 = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
                while( $row3 = mysqli_fetch_assoc($result3) ) {
                $user_id2  = $row3['id']; 
                } ?>
                <table border="0" align="center" width="75%" cellpadding="7" bordercolor="Black">
                <?php if($user_id2 == $row["user_id"]){
                    if ($edit_id == $row["id"]){ ?>
                        <td bgcolor='#bf178a' align='right'>
                        <a style="color: Black;" href="/comment.php">Скасувати редагування</a>
                        <a style="color: Black;" href="delete_comment.php?id=<?=$row["id"]?>">Видалити</a>
                        </td><tr>
                    <?php } else { ?>   
                    <td bgcolor='#eb8934' align='right'>
                    <a style="color: Black;" href="edit_comment.php?id=<?=$row["id"]?>">Редагувати</a>
                    <a style="color: Black;" href="delete_comment.php?id=<?=$row["id"]?>">Видалити</a>
                    </td><tr>
                <?php }} else { ?>
                    <td bgcolor='#eb8934' align='right'>
                        <a style="color: Black;" href="reply_comment.php?id=<?=$row["id"]?>">Відповісти</a>
                <?php } ?>
                </table>
                <?php       
                $sql_reply = "SELECT * FROM reply_comment ORDER BY id_reply DESC"; 
                $result_reply = $mysql->query($sql_reply);
                if ($result_reply->num_rows > 0) {
                    while($row_reply = $result_reply->fetch_assoc()) {
                    $id_reply_user = $row_reply['id_reply_user'];
                    $result_reply_2 = $mysql->query("SELECT * FROM `users` WHERE `id`='$id_reply_user'");
                    while( $row_reply_2 = mysqli_fetch_assoc($result_reply_2) ) {
                        $name_user_reply  = $row_reply_2['name']; 
                    }
                    if ($row_reply['id_comment'] == $row["id"]){ ?>
                        <br><br>
                        <table border="0" align="center" width="69%" cellpadding="7" bordercolor="Black" style="margin-right: 138px;">
                        <?php
                        if ($row_reply["edit_date_reply"] != ''){ ?>
                            <td bgcolor='#9bd930' align='left'>&#9989 Ім'я: <?=$name_user_reply?></td>
                            <td bgcolor='#9bd930' align='right'>Час: <?=$row_reply["date_reply"]?> (Ред.: <?=$row_reply["edit_date_reply"]?>)</td><tr>
                        <?php } else { ?>
                            <td bgcolor='#9bd930' align='left'>&#9989 Ім'я: <?=$name_user_reply?></td>
                            <td bgcolor='#9bd930' align='right'>Час: <?=$row_reply["date_reply"]?></td><tr>
                        <?php } ?>
                    </table>
                    <table border="0" align="center" width="69%" cellpadding="15" bordercolor="Black" style="margin-right: 138px;">
                    <?php if ($idForEditReplyOnComment == $row_reply["id_reply"]){ ?>
                        <td bgcolor='#adadad'><?=$row_reply["reply_comment"]?></td><tr>
                    <?php } else { ?>  
                        <td bgcolor='white'><?=$row_reply["reply_comment"]?></td><tr>
                    <?php } ?>
                    </table>
                    <table border="0" align="center" width="69%" cellpadding="7" bordercolor="Black" style="margin-right: 138px;">
                    <?php if($user_id2 == $row_reply["id_reply_user"]){
                        if ($idForEditReplyOnComment == $row_reply["id_reply"]){?>
                            <td bgcolor='#bf178a' align='right'>
                            <a style="color: Black;"  href="/comment.php">Скасувати редагування</a>
                            <a style="color: Black;"  href="delete_reply_comment.php?idReplyComment=<?=$row_reply["id_reply"]?>">Видалити</a></td><tr>
                        <?php } else { ?>
                            <td bgcolor='#eb8934' align='right'>
                            <a style="color: Black;"  href="edit_reply_for_comment.php?replyOnCommentId=<?=$row_reply["id_reply"]?>">Редагувати</a>
                            <a style="color: Black;"  href="delete_reply_comment.php?idReplyComment=<?=$row_reply["id_reply"]?>">Видалити</a></td><tr>
                        <?php } } else { ?>
                    <td bgcolor='#eb8934' align='right'>
                    <a style="color: Black;" href="reply_sub_comment.php?id=<?=$row_reply["id_reply"]?>">Відповісти</a></td><tr>
                    <?php } ?>
                </table>
                <?php        
                $sqlSubComment = "SELECT * FROM reply_comment ORDER BY id_reply DESC"; 
                $resultSubComment = $mysql->query($sqlSubComment);
                if ($resultSubComment->num_rows > 0) {
                    while($rowSubComment = $resultSubComment->fetch_assoc()) {
                        $idUserSubComment = $rowSubComment['id_reply_user'];
                        $resultSubComment2 = $mysql->query("SELECT * FROM `users` WHERE `id`='$id_reply_user'");
                        while( $rowSubComment2 = mysqli_fetch_assoc($resultSubComment2)){
                            $nameUserSubComment  = $rowSubComment2['name']; 
                        }
                if ($rowSubComment['id_sub_comment'] == $row_reply['id_reply']){ ?>
                    <br><br>
                    <table border="0" align="center" width="62%" cellpadding="7" bordercolor="Black" style="margin-right: 138px;">
                    <?php 
                    if ($rowSubComment["edit_date_reply"] != ''){ ?>
                        <td bgcolor='#d12492' align='left'>&#128293 Ім'я: <?=$nameUserSubComment?></td>
                        <td bgcolor='#d12492' align='right'>Час: <?=$rowSubComment["date_reply"]?> (Ред.: <?=$rowSubComment["edit_date_reply"]?>)</td><tr>
                    <?php } else { ?>
                        <td bgcolor='#d12492' align='left'>&#128293 Ім'я: <?=$nameUserSubComment?></td>
                        <td bgcolor='#d12492' align='right'>Час: <?=$rowSubComment["date_reply"]?></td><tr>
                    <?php } ?>
                    </table>
                    <table border="0" align="center" width="62%" cellpadding="15" bordercolor="Black" style="margin-right: 138px;">
                    <td bgcolor='white'><?=$rowSubComment["reply_comment"]?></td><tr>
                    </table>
                    <table border="0" align="center" width="62%" cellpadding="7" bordercolor="Black" style="margin-right: 138px;">
                    <?php if($user_id2 == $rowSubComment["id_reply_user"]){
                     ?>
                        <td bgcolor='#eb8934' align='right'>
                        <a style="color: Black;"  href="edit_sub_comment.php?editSubComment=<?=$rowSubComment["id_reply"]?>">Редагувати</a>
                        <a style="color: Black;"  href="delete_sub_comment.php?idDeleteSubComment=<?=$rowSubComment["id_reply"]?>">Видалити</a></td><tr>
                    <?php } ?>
                    </table>
                    <?php } } } 
                } } } } } ?>
                <br><br>
    <?php $mysql->close();
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/footer.php'; ?>