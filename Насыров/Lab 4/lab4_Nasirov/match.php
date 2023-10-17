<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Матчи</title>
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
            <h2>История матчей</h2>
            <?php
            include "database/connect.php";
            $result = "Select *, Команды.Название from Матчи 
    INNER JOIN Команды ON (Матчи.ID_Победителя = Команды.ID_Команды)";
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                $date = strtotime($row['Дата_матча']);
                $new_date = date('d.m.Y', $date);
                echo '<div class="team row">
                        <div class="img col-12 col-md-4">
                            <img src="'.$row['Логотип_команды'].'" alt="Логотип команды" class="img-thumbnail">
                        </div>
                        <div class="team_text col-12 col-md-8">';
                echo '<h3>Номер_матча: '.$row['ID_Матча'].'</h3>';
                echo '<p>Дата матча: '.$new_date.'</p>';
                echo '<p>Победитель: '.$row['Название'].'</p>';
                echo '<p>Арена: '.$row['Место_провед'].'</p>';
                echo '<p>Счет: '.$row['Счет'].'</p>';
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

