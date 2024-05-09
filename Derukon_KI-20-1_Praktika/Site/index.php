<?php 
    $location = 'index';
    include 'layouts/header.php';
    include 'layouts/navbar.php'; 
?>

<div class="container mt-4">
    <?php if (!isset($_COOKIE['user'])): ?>
        <div class="row">
            <div class="col" align="center">
                <h1>Форма авторизації</h1>
                <form action="validation-form/auth.php" method="post">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Ввеіть електронну адресу"><br>
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Введіть пароль"><br>
                    <button class="btn btn-success" type="submit">Авторизуватися</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <meta http-equiv="refresh" content="0;/kabinet.php">
    <?php endif; ?>
</div>

<?php include 'layouts/footer.php'; ?>
