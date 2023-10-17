<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <?php
    include "connect.php";
    session_start();
    unset($_SESSION['message']);
    if(isset($_POST['reg'])){
        reg($_POST['login'], $_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['pass'], $_POST['adres']);
    }
    ?>
</head>
<body>
<!--Header-->
<?php
include "header.php"
?>
<div class="container reg_form">
    <form class="row justify-content-center logreg" method="post" action="" name="register">
        <h2 align="center">Форма регистрации</h2>
        <div class="mb-3 col-12 col-md-4">
            <label class="form-label">Логин</label>
            <input name="login" type="text" class="form-control" placeholder="Введите ваш Логин">
            <span id="valid_pass_message" class="mesage_error"></span>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label class="form-label">ФИО</label>
            <input name="fullname" type="text" class="form-control" placeholder="Введите ваше ФИО">
            <span id="valid_pass_message" class="mesage_error"></span>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label class="form-label">email</label>
            <input name="email" type="email" class="form-control" placeholder="Введите вашу почту">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label class="form-label">Телефон</label>
            <input name="phone" type="text" class="form-control" placeholder="Введите ваш телефон">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label class="form-label">Адрес</label>
            <input name="adres" type="text" class="form-control" placeholder="Введите ваш адрес">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label class="form-label">Пароль</label>
            <input name="pass" type="password" class="form-control" placeholder="Введите пароль">
        </div>
        <span id="valid_pass_message" class="mesage_error"></span>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4 btn-reg">
            <button type="submit" class="btn btn-primary" name="reg">Зарегистрироваться</button>
            <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
        </div>
    </form>
</div>
<?php
echo $_SESSION['message'];
?>
<?php
include "footer.php";
?>
</body>
</html>
<?php
function clear($string){
    $string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = htmlspecialchars($string);
    return $string;
}
function checkSize($string,$min,$max)
{
    $result = (mb_strlen($string) > $min && mb_strlen($string) <= $max);
    return $result;
}

function reg($login, $name, $email, $phone, $pass, $adres){
    clear($login);
    clear($name);
    clear($email);
    clear($phone);
    clear($pass);
    clear($adres);
    unset($_SESSION['message']);
    if(!checkSize($phone, 6, 20))
        $_SESSION['message'] = "<center><strong><i>Номер некорректен</i></strong></center>";

    if(!checkSize($name, 10, 60))
        $_SESSION['message'] = "<center><strong><i>Имя некорректно</i></strong></center>";

    elseif(!checkSize($login, 3, 50))
        $_SESSION['message'] = "<center><strong><i>Логин должен иметь длинну не больше 20 и не меньше 3 символов</i></strong></center>";

    elseif(!checkSize($pass, 1, 18))
        $_SESSION['message'] = "<center><strong><i>Пароль должен иметь длинну не больше 18 и не меньше 1 символов</i></strong></center>";
    else {
        include "connect.php";
        $quer = 'SELECT COUNT(*) FROM Клиент WHERE `Логин` LIKE \''.$login.'\'';
        $checkUsers = mysqli_query($conn,$quer)or die("Ошибка авторизации" . mysqli_error($conn));
        $row = mysqli_fetch_row($checkUsers);
        if($row[0] > 0)
        {
            $_SESSION['message'] = "<center><i>Клиент с данным логином уже существует</i></center>";
        }
        else {
            $insert = "INSERT INTO `Клиент` (`ID_Клиента`, `ФИО`, `email`, `Логин`, `Пароль`, `Телефон`, `Адрес_получателя`) VALUES (NULL, '$name', '$email', '$login', '$pass', '$phone', '$adres')";

            $insert = mysqli_query($conn, $insert) or die("Ошибка добавления данных " . mysqli_error($conn));

            $_SESSION['message'] = "<center><strong><i>Клиент зарегистрирован</i></strong></center>";
            header('Refresh: 1; URL = login.php');

        }
    }

}


