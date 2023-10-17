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
    include "database/connect.php";
    session_start();
    unset($_SESSION['message']);
    if(isset($_POST['reg'])){
        reg($_POST['login'], $_POST['fullname'], $_POST['email'], $_POST['pass']);
    }
    ?>
</head>
<body>
<!--Header-->
<?php
include "header.php"
?>
<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="" name="register">
        <h2>Форма регистрации</h2>
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

function reg($login, $name, $email, $pass){
    clear($login);
    clear($name);
    clear($email);
    clear($pass);
    unset($_SESSION['message']);

    if(!checkSize($name, 5, 60))
        $_SESSION['message'] = "<center><strong><i>Имя некорректно</i></strong></center>";

    elseif(!checkSize($login, 3, 50))
        $_SESSION['message'] = "<center><strong><i>Логин должен иметь длинну не больше 20 и не меньше 3 символов</i></strong></center>";

    elseif(!checkSize($pass, 1, 18))
        $_SESSION['message'] = "<center><strong><i>Пароль должен иметь длинну не больше 18 и не меньше 1 символов</i></strong></center>";
    else {
        include "database/connect.php";
        $quer = 'SELECT COUNT(*) FROM user WHERE `Логин` LIKE \''.$login.'\'' ;
        $checkUsers = mysqli_query($conn,$quer)or die("Ошибка авторизации" . mysqli_error($conn));
        $row = mysqli_fetch_row($checkUsers);
        if($row[0] > 0)
        {
            $_SESSION['message'] = "<center><i>Пользователь с данным логином уже существует</i></center>";
        }
        else {
            $insert = "INSERT INTO `user` (`id_user`, `ФИО_пользователя`, `email`, `Логин`, `Пароль`) VALUES (NULL, '$name', '$email', '$login', '$pass')";

            $insert = mysqli_query($conn, $insert) or die("Ошибка добавления данных " . mysqli_error($conn));

            $_SESSION['message'] = "<center><strong><i>Пользователь добавлен</i></strong></center>";

        }
    }

}

