<?php
include_once('functions.php');
$location  = 'loading'; 
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/navbar.php'; ?>

    <div class="container mt-4">

        <?php if (!isset($_COOKIE['user'])): ?>          
        <meta http-equiv="refresh" content="0; /index.php">
        <?php endif; ?>
    	
    	<div class="row">        
            <div class="col" align="center">
                <h2>Форма зміни фотографії</h2><br>

    				<form method="post" enctype="multipart/form-data">
      					<input type="file" class="btn btn-primary" name="file"><br><br>
      					<input type="submit" class="btn btn-success" value="Завантажити файл!">
    				</form>
    				<br>
                    <?php // если была произведена отправка формы
                    if(isset($_FILES['file'])) {
      	                // проверяем, можно ли загружать изображение
      	                $check = can_upload($_FILES['file']);
                        if($check === true){ 
                            // загружаем изображение на сервер
        	                make_upload($_FILES['file']);
        	                echo "<strong>Файл успішно завантажено!</strong>"; ?>
                            <br><h3><a style="color: Black;" href="/kabinet.php">Повернутись до особистого кабінету?</a></h3><br>
                            <?php $hash = $_COOKIE['user'];
        	                include 'database.php';
    		                $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
    		                while( $row = mysqli_fetch_assoc($result) ) { 
        	                $avatar = $row['avatar'];
			            } ?>
			        <h1 align="center">
                    <img style="width: 50%; height: 50%;" src="<?=$avatar?>">
                    </h1>
                    <?php } else { // выводим сообщение об ошибке
        	           echo "<strong>$check</strong>";  
      	             }
                } ?>
    		</div>
    	</div>	
<?php include $_SERVER['DOCUMENT_ROOT'] . '/layouts/footer.php'; ?>