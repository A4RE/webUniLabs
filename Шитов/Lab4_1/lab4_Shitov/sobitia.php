<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>События</title>
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
<!--Header-->
<?php
include "header.php";
?>
<!--Main block start-->
<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content row justify-content-center col-md-12">
            <h2>Список акций и событий</h2>
            <?php
            include "vendor/connect.php";
            $result = "Select *, Кафе.* from Событие INNER JOIN Кафе ON (Событие.id_кафе = Кафе.ID_кафе)";
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $startDate = strtotime($row['Начало_акции']);
                $endDate = strtotime($row['Конец_акции']);
                $newStart = date('d.m.Y', $startDate);
                $newEnd = date('d.m.Y', $endDate);
                echo '<div class="cafe_text_sobit mb-2 col-12 col-md-3">';
                echo '<h3>' .$row['Название_события'].'</a></h3>';
                echo '<p>Адрес - '.$row['Адрес'].'</p>
                      <p>Описание - '.$row['Описание'].'</p>
                      <p>Тип - '.$row['Тип'].'</p>
                      <p>Начало акции - '.$newStart.'<br>Конец акции - '.$newEnd.'</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<!--Main block end-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
