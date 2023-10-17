<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новости</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <?php
    include "base/setup.php";
    session_start();
    unset($_SESSION['message']);
    ?>
</head>
<body>
<!--Header-->
<?php
include "components/header.php";
?>

<!--Main block start-->
<div class="container">
    <div class="content row">
        <!--    content-->
        <div class="main-content col-md-12 col-12">
            <h2>Последние события</h2>
            <?php
            include "base/setup.php";
            $result = "Select *, Организатор.ФИО_Организатора from События 
                        INNER JOIN Организатор ON (События.id_организатора = Организатор.id_организатора) 
                                       order by id_события DESC";
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $date_start = strtotime($row['Дата_начала_выставки']);
                $new_date_start = date( 'd.m.Y', $date_start);
                $date_end = strtotime($row['Дата_конца_выставки']);
                $new_date_end = date( 'd.m.Y', $date_end);
                echo '<div class="vistavka row">
                <div class="vistavka_text col-12 col-md-8">';
                echo '<h3>'.$row['Название_события'].'</a></h3>';
                echo '<p class="preview-text">'.$row["Описание_события"].'</p>';
                echo '<p><i class="bx bx-user">Организатор - '.$row['ФИО_Организатора'].'</i></p>';
                echo '<p>Проведение события с '.$new_date_start.' по '.$new_date_end.'</p>';
                echo '</div>
                        <div class="img col-12 col-md-4">
                        <img src="'.$row['Изображение'].'"alt="Картина" class="img-thumbnail">
                        </div></div>';
            }
            ?>
        </div>
    </div>
</div>
<!--Main block end-->
<?php
include "components/footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
