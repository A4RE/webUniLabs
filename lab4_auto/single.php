<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница Автомобилей</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?php
    include "connect.php";
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
        <div class="main-content col-12" style="padding-top: 20px">
            <?php
            include "connect.php";
            $page = $_GET['id'];
            $result = 'Select * from Производство WHERE id_производства ='.$page;
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            echo '<div class="single_agency row">
                <div class="img col-12 col-md-4">
                     <img src="'.$row['Логотип'].'" alt="Логотип агентства" class="img-thumbnail">;
                </div>';
            echo "<div class='info col-md-8'>";
            echo '<h2>'.$row['Название_производства'].'</h2>';
            echo "<h3><i class='bx bx-building'>Страна производства: ".$row['Страна_производства']."</i></h3>";
            echo "</div>";
            ?>
            <div class="single_agency_text col-12">
                <h4>Модели:</h4>
                <?php
                include "connect.php";
                $res = "Select *, Производство.Название_производства from автомобиль INNER JOIN Производство ON 
                    (автомобиль.id_производства = Производство.id_производства) WHERE Производство.id_производства=".$page;
                $res = mysqli_query($conn, $res) or die("Ошибка запроса Select". mysqli_error($conn));
                while($row = mysqli_fetch_assoc($res)){
                    echo '<div class="agency row">
                        <div class="img col-12 col-md-4">
                            <img src="'.$row['Изображение'].'" alt="Изображение автомобиля" class="img-thumbnail">
                        </div>
                        <div class="agency_text col-12 col-md-8">';
                    echo '<p>'.$row['Название_производства'].' '.$row['Название_модели'].'</p>';
                    echo '<p class="preview-text">Мощность: '.$row["Мощность"].'</p>';
                    echo '<p class="preview-text">Описание: '.$row["Описание"].'</p>';
                    echo '</div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!--
    MAIN BLOCK END
-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>