<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница зоопарка</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?php
    include "vendor/connect.php";
    session_start();
    unset($_SESSION['message']);
    ?>

</head>
<body>
<!--
    HEADER
-->
<?php
include "header.php";
?>

<!--
    MAIN BLOCK
-->
<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content col-md-12 col-12">
            <?php
            include "vendor/connect.php";
            $page = $_GET['id'];
            $result = 'Select * from Зоопарк WHERE ID_зоопарка ='.$page;
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            echo '<h2>'.$row['Назв_зпарка'].'</h2>';
            echo '<div class="zoo row">
                <div class="img col-12 col-md-4">
                     <img src="'.$row['Фотография'].'" alt="Изображение зоопарка" class="img-thumbnail">
                </div>';
            echo "<div class='zoo_text col-12 col-md-8'>";
            echo '<p>Город - '.$row['Город'].'</p>
                      <p>Год открытия - '.$row['Год_открытия'].'</p>
                      <p>Телефон - '.$row['Телефон'].'</p>
                      <p>Адрес - '.$row['Адрес'].'</p>';
            echo "</div>";
            ?>
            <div style="border-top: black 1px solid; margin: 10px 0" class="single_zoo_text col-12 col-md-12">
                <h4 style="margin: 10px 0">Животные зоопарка</h4>
                <?php
                include "vendor/connect.php";
                $res = "Select *, Виды_жив.Назв_вида, Зоопарк.Назв_зпарка from Животные
                        INNER JOIN Виды_жив ON (Животные.ID_вида = Виды_жив.ID_вида)
                        INNER JOIN Зоопарк ON (Животные.ID_зоопарка = Зоопарк.ID_зоопарка)
                        WHERE Зоопарк.ID_зоопарка=".$page;
                $res = mysqli_query($conn, $res) or die("Ошибка запроса Select". mysqli_error($conn));
                if($res){
                    while($row = mysqli_fetch_assoc($res)){
                        $date = strtotime($row['Дата_поступл']);
                        $new_date = date('d.m.Y', $date);
                        echo '<div class="zoo row">
                                <div class="img col-12 col-md-4">
                                    <img src="'.$row['Фото_животного'].'" alt="Изображение животного" class="img-thumbnail">
                               </div>';
                        echo "<div class='zoo_text col-12 col-md-8'>";
                        echo '<p>Кличка - '.$row['Кличка'].'</p>
                      <p>Вид - '.$row['Назв_вида'].'</p>
                      <p>Родина - '.$row['Родина'].'</p>
                      <p>Возраст - '.$row['Возраст'].'</p>
                      <p>Дата поступления - '.$new_date.'</p>
                      <p>Рацион - '.$row['Рацион'].'</p>';
                        echo "</div></div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>


<!--
    MAIN BLOCK END
-->
<!--FOOTER BLOCK-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
