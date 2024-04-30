<?php
	include 'database.php'; 
if ($_GET['hash']) {
    $hash = $_GET['hash'];
    if ($result = $mysql->query("SELECT * FROM `users` WHERE `hash`='" . $hash . "'")) {
        while( $row = mysqli_fetch_assoc($result) ) { 
            if ($row['email_confirmed'] == 1) {
                $mysql->query("UPDATE `users` SET `email_confirmed`=0 WHERE `id`=". $row['id'] );
                $mysql->close();
                header('Location: /index.php');
            } else {
                echo "Щось пішло не так";
            }
        } 
    } else {
        echo "Щось пішло не так";
    }
} else {
    echo "Щось пішло не так";
}
$mysql->close();
?>