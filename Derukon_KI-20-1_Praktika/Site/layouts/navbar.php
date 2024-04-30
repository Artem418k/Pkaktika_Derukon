<?php 
 switch($location){
    case 'kabinet':
        $content = '1';
        break;
    case 'comment':
        $content = '1';
        break;
    case 'index':
        $content = '1';
        break;
    case 'reg':
        $content = '1';
        break;
    case 'edit_reply_for_comment':
        $content = '0';
        break;
    case 'edit_sub_comment':
        $content = '0';
        break;
    case 'loading':
        $content = '0';
        break;
    case 'reply_comment':
        $content = '0';
        break;
    case 'reply_sub_comment':
        $content = '0';
        break;
    case 'edit_comment':
        $content = '0';
        break; 
}
?>

<body>
    <nav class="top-menu">
        <ul class="menu-main">

            <?php if (!isset($_COOKIE['user'])): ?>
                <li><a href="reg.php">Зареєструватися</a></li>
                <li><a href="index.php">Увійти</a></li>

            <?php else: 
                if ($content == '1'){ 
                    ?>
                    <li><a href="kabinet.php">Особистий кабінет</a></li>
                    <li><a href="comment.php">Форум</a></li>
                    <li><a href="validation-form/exit.php">Вийти</a></li>
                    <?php 
                } else {
                    ?>
                    <li><a href="/kabinet.php">Особистий кабінет</a></li>
                    <li><a href="/comment.php">Форум</a></li>
                    <li><a href="/validation-form/exit.php">Вийти</a></li>
                    <?php 
                }
                endif; ?>
        </ul>
    </nav>   