<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница обратной связи</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <?php
    include "vendor/connect.php";
    session_start();
    unset($_SESSION['message']);
    ?>

</head>
<body>
<?php
include "header.php";
?>
<div class="container obr_svyaz">
    <form class="row justify-content-center form-obr-svaz" method="post">
        <h2>Форма Обратной связи</h2>
        <p align="left" style="margin-left: 30px; padding: 10px;">
            <b>Если вы хотите получить какую-либо дополнительную информацию, то
                заполните форму ниже. Мы пришлем ответ на интересующий вас вопрос в течении пары дней.</b></p>
        <div style="width: 40%">
            <center>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4" style="width: 80%">
                    <label class="form-label">Тема письма</label>
                    <input type="text" class="form-control" name="theme" placeholder="Введите Тему письма">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4" style="width: 80%">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Введите ваш email">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4" style="width: 80%">
                    <label class="form=label">Ваше сообщение</label>
                    <textarea class="form-control" name="msg" placeholder="Введите ваше сообщение" maxlength="200"></textarea>
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4 btn-reg">
                    <button type="submit" name='send' class="btn btn-primary">Отправить</button>
                </div>
            </center>
        </div>
    </form>
    <?php
    if(isset($_POST['send'])){
        mail($_POST['theme'], $_POST['email'], $_POST['msg'], 'From: gerasimenko@gmail.com');
        echo "<center><strong><i>Вам отправлено письмо!</i></strong></center><br>";
        header('Refresh: 1.5; URL = svaz.php');

    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>


