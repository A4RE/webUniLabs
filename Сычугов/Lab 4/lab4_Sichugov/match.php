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
include "components/header.php";
?>

<!--Main block start-->
<div class="container">
    <div class="content row">

        <!--    content-->
        <center>
        <div class="main-content col-md-12 col-12">
            <h2>Новости</h2>
            <?php
            include "vendor/connect.php";
            $result = "Select *, Команда.Название_команды from Новость INNER JOIN Команда ON (Новость.id_команды = Команда.ID_Команды)
            order by id_новости DESC";
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $date = strtotime($row['Время_новости']);
                $new_date = date('d.m.Y H:i', $date);
                echo '<div class="team row">
                        <div class="team_text col-12 col-md-12">';
                echo '<h3><a href="match.php?id='.$row['id_новости'].'">'.$row['Название_новости'].'</a></h3>';
                echo '<p>Автор: '.$row['Автор'].'</p>';
                echo '<p>'.$new_date.'</p>';
                echo '</div></div>';
            }
            ?>
        </div>
        </center>
    </div>
</div>
<!--Main block end-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>

