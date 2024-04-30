<?php $location  = 'kabinet'; 
include 'layouts/header.php';
include 'layouts/navbar.php'; ?>


    <div class="container mt-4">

        <?php if (!isset($_COOKIE['user'])): ?>          

        <meta http-equiv="refresh" content="0; /index.php">

    <?php else: 
        include 'validation-form/database.php';
        $hash = $_COOKIE['user'];
        $result = $mysql->query("SELECT * FROM `users` WHERE `hash`='$hash'");
        while( $row = mysqli_fetch_assoc($result) ) { 
            $nameK = $row['name'];
            $surnameK = $row['surname'];
            $phone_numberK = $row['phone_number'];
            $emailK = $row['email'];
            $avatar = $row['avatar']; 
            $mysql->close();
            }?>
        <h1 align="center">
        <?php if ($avatar == ''){
                $avatar = '/photo/dog.jpg';
            }?>

        <img style="width: 35%; height: 35%;" src="<?=$avatar?>"><br>Привіт, <?=$nameK?>!</h1><br></h1><br>
        <div class="row">        
            <div class="col" align="center">
                <h2>Форма для зміни даних</h2>
                <h3>Можна змінити всі значення відразу або лише одне</h3>
                <form action="validation-form/rename.php" method="post">
                <textarea class="form-control" name="name" id="name" rows="1"><?=$nameK?></textarea><br>
                <textarea class="form-control" name="surname" id="surname" rows="1"><?=$surnameK?></textarea><br>
                <textarea class="form-control" name="phone_number" id="phone_number" rows="1"><?=$phone_numberK?></textarea><br>
                <textarea class="form-control" name="email" id="email" rows="1"><?=$emailK?></textarea><br>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Введіть новий пароль"><br>
                <input type="password" class="form-control" name="passpodtv" id="passpodtv" placeholder="Підтвердіть новий пароль"><br>
                <button class="btn btn-success" type="submit">Змінити дані</button>
                <a href="validation-form/loading.php" class="btn btn-primary" >Змінити фото</a>
                <a href="validation-form/delete_photo.php" class="btn btn-danger" >Видалити фото</a><br><br><br>
                </form>
            </div>
        </div>
    <?php endif; 
include 'layouts/footer.php'; ?>