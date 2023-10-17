<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новости</title>
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
<!--Header-->
<?php
include "header.php";
?>

<!--Main block start-->
<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content col-md-8 col-12">
            <h2>Новости из мира автомобилей</h2>
            <?php
            include "connect.php";
            $result = "Select *, Производство.Название_производства from Новости INNER JOIN Производство ON (Новости.id_производства   = Производство.id_производства ) 
                                       order by id_новости DESC";
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $date = strtotime($row['Дата_новости']);
                $new_date = date( 'd.m.Y H:i:s', $date);
                echo '<div class="agency row">
                        <div class="agency_text col-12 col-md-12">';
                echo '<h3><a href="single_news.php?id='.$row['id_новости'].'">'.$row['Title'].'</a></h3>';
                echo '<p class="preview-text">Производство: '.$row["Название_производства"].'</p>';
                echo '<h4>Время новости: '.$new_date.'</h4>';
                echo '</div></div>';
            }
            ?>
        </div>
    </div>
</div>
<!--Main block end-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
