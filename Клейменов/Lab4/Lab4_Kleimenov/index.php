<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
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
    ?>
</head>
<body>
<!--Header-->
<?php
include "header.php";
?>

<!--Main block start-->
<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content col-md-12 col-12">
            <h2>Мы занимаемся строительством домов любой сложности и любых размеров. Наши проекты разработаны опытными специалистами с учетом всех требований и пожеланий наших клиентов.</h2>
        </div>
        <div class="main-content row justify-content-center col-md-12">
            <?php
            include "connect.php";
            $result = 'Select *, Макет.* from Дом INNER JOIN Макет on (Дом.id_макета = Макет.id_макета)';
            $result = mysqli_query($conn, $result) or die ('Ошибка Select '.mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                echo '<div class="main-page-style col-12 col-md-4">
                        <h3>'.$row['Название_проекта'].'</h3>
                        <div class="img_house">
                        <img src="'.$row['Фото_дома'].'" alt="Изображение дома">
                        </div>
                        <div class="house_text">
                      <p>Количество этажей: '.$row['Кол_этажей'].'<br>Макет: '.$row['Название_макета'].'<br>
                      Цена дома: '.$row['Цена'].'</p>
                       </div></div>';
            }
            ?>
        </div>
    </div>
</div>
<!--Main block end-->
<?php
include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>

