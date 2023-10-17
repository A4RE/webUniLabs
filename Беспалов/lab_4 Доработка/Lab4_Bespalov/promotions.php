<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Акции</title>
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
            <h2>Акции в наших магазинах:</h2>
        </div>
        <div class="main-content row justify-content-center col-md-12">
            <?php
            include "connect.php";
            $qur = 'Select COUNT(*) from Акции';
            $ch_qur = mysqli_query($conn, $qur)or die("Ошибка" . mysqli_error($conn));
            $rw = mysqli_fetch_array($ch_qur);
            $count = $rw[0];
            $prom = rand(1, $count);
            $result = 'SELECT *, `Магазин`.* FROM `Акции` INNER JOIN `Магазин` ON (`Акции`.`id_акции` = `Магазин`.`id_магазина`) WHERE `id_акции` ='.$prom;
            $result = mysqli_query($conn, $result) or die("Ошибка запроса ".mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $startProm = strtotime($row['Начало_акции']);
                $endProm = strtotime($row['Конец_акции']);
                $newStartProm = date('d.m.Y', $startProm);
                $newEndProm = date('d.m.Y', $endProm);
                echo '<div class="shop col-12 col-md-4">';
                echo '<h3>'.$row['Название_акции'].'</h3>';
                echo '<p>'.$row['Описание_акции'].'</p>
                      <p>Акция проходит в магазине по адресу: '.$row['Адрес_магазина'].'</p>
                      <p>Акция проходит с '.$newStartProm.' по '.$newEndProm.'</p>
                      <p>'.$row['Блок_карты'].'</p>
                      </div>';
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


