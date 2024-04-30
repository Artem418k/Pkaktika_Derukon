<?php $location  = 'comment';
include 'layouts/header.php';
include 'layouts/navbar.php'; ?>

    <div class="container mt-4">

        <?php if (!isset($_COOKIE['user'])): ?>
        <meta http-equiv="refresh" content="0; index.php">

        <?php else: 
            include 'validation-form/database.php';
            $hash = $_COOKIE['user'];
            $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
            while( $row = mysqli_fetch_assoc($result) ) { 
                $nameC = $row['name'];
                }?>

        <div class="row">
            <div class="col" align="center">
                <h1>Форум</h1>
                <form action="validation-form/check_comment.php" method="post">
                <div class="mb-3">
                <label for="comment" class="form-label">Питання буде від Вашого імені: <?=$nameC?></label>
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Ваше запитання"></textarea><br>
                <button class="btn btn-info" type="submit">Надіслати питання</button>
                </form>
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
                }?>
                <br><br>
                <table border="0" align="center" width="75%" cellpadding="7" bordercolor="Black">

                <?php
                if ($row["date_edit"] != ''){ ?>
                    <td bgcolor='#0dd3de' align='left'>Ім'я: <?=$name?></td>
                    <td bgcolor='#0dd3de' align='right'>Час: <?=$row["date_c"]?> (Ред.: <?=$row["date_edit"]?>)</td><tr>
                <?php } else { ?>
                    <td bgcolor='#0dd3de' align='left'>Ім'я: <?=$name?></td>
                    <td bgcolor='#0dd3de' align='right'>Час: <?=$row["date_c"]?></td><tr>
                <?php }?>
                </table>
                <table border="0" align="center" width="75%" cellpadding="15" bordercolor="Black">
                <td bgcolor='white'><?=$row["comment"]?></td><tr>
                </table>
                
                <?php                
                $hash = $_COOKIE['user'];
                $result3 = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
                while( $row3 = mysqli_fetch_assoc($result3) ) {
                    $user_id2  = $row3['id']; 
                }?>
                <table border="0" align="center" width="75%" cellpadding="7" bordercolor="Black">
                <?php if($user_id2 == $row["user_id"]){
                 ?>                  
                    <td bgcolor='#eb8934' align='right'>
                    <a style="color: Black;" href="validation-form/edit_comment.php?id=<?=$row["id"]?>">Редагувати</a>
                    <a style="color: Black;" href="validation-form/delete_comment.php?id=<?=$row["id"]?>">Видалити</a>
                    </td><tr>
                <?php } else { //Відповісти на комментарий?>
                    <td bgcolor='#eb8934' align='right'>
                        <a style="color: Black;" href="validation-form/reply_comment.php?id=<?=$row["id"]?>">Відповісти</a>
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

                    if ($row_reply['id_comment'] == $row["id"]){?> 
                        <br><br><table border="0" align="right" width="69%" cellpadding="7" bordercolor="Black" style="margin-right: 138px;">
                    <?php
                    if ($row_reply["edit_date_reply"] != ''){?>
                    <td bgcolor='#9bd930' align='left'>&#9989 Ім'я: <?=$name_user_reply?></td>
                    <td bgcolor='#9bd930' align='right'>Час: <?=$row_reply["date_reply"]?> (Ред.: <?=$row_reply["edit_date_reply"]?>)</td><tr>
                    <?php } else { ?>
                    <td bgcolor='#9bd930' align='left'>&#9989 Ім'я: <?=$name_user_reply?></td>
                    <td bgcolor='#9bd930' align='right'>Час: <?=$row_reply["date_reply"]?></td><tr>
                    <?php } ?>
                    </table>
                    <table border="0" align="center" width="69%" cellpadding="15" bordercolor="Black" style="margin-right: 138px;">
                    <td bgcolor='white'><?=$row_reply["reply_comment"]?></td><tr>
                    </table>
                    <table border="0" align="center" width="69%" cellpadding="7" bordercolor="Black" style="margin-right: 138px;">

                    <?php if($user_id2 == $row_reply["id_reply_user"]){
                    ?>

                        <td bgcolor='#eb8934' align='right'>
                        <a style="color: Black;"  href="validation-form/edit_reply_for_comment.php?replyOnCommentId=<?=$row_reply["id_reply"]?>">Редагувати</a>
                        <a style="color: Black;"  href="validation-form/delete_reply_comment.php?idReplyComment=<?=$row_reply["id_reply"]?>">Видалити</a></td><tr>
                    <?php } else {?>
                    <td bgcolor='#eb8934' align='right'>
                    <a style="color: Black;" href="validation-form/reply_sub_comment.php?id=<?=$row_reply["id_reply"]?>">Відповісти</a></td><tr>
                    <?php } ?>
                    </table>
                
                    <?php      
                    $sqlSubComment = "SELECT * FROM reply_comment ORDER BY id_reply DESC";
                    $resultSubComment = $mysql->query($sqlSubComment);
                    if ($resultSubComment->num_rows > 0) {
                        while($rowSubComment = $resultSubComment->fetch_assoc()) {
                        $idUserSubComment = $rowSubComment['id_reply_user'];
                        $resultSubComment2 = $mysql->query("SELECT * FROM `users` WHERE `id`='$idUserSubComment'");
                        while( $rowSubComment2 = mysqli_fetch_assoc($resultSubComment2) ) {
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

                        <?php if($user_id2 == $rowSubComment["id_reply_user"]){ ?>
                            <td bgcolor='#eb8934' align='right'>
                            <a style="color: Black;"  href="validation-form/edit_sub_comment.php?editSubComment=<?=$rowSubComment["id_reply"]?>">Редагувати</a>
                            <a style="color: Black;"  href="validation-form/delete_sub_comment.php?idDeleteSubComment=<?=$rowSubComment["id_reply"]?>">Видалити</a></td><tr>
                        <?php } ?>
                        </table>
                
                <?php } } }
                } } } } }?>
                <br><br>
    <?php $mysql->close();
include 'layouts/footer.php'; ?>