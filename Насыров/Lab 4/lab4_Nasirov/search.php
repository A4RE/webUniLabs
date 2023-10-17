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
            <h2>Список Команд</h2>
            <?php
            include "database/connect.php";
            $searchText = $_POST['search-term'];
            $result = "Select *, Конференция.Название_конф from Команды 
    INNER JOIN Конференция ON (Команды.ID_Конференции = Конференция.ID_конф) WHERE Название LIKE  '%$searchText' or Конференция.Название_конф like '%$searchText'";
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                echo '<div class="team row">
                        <div class="img col-12 col-md-4">
                            <img src="'.$row['Логотип_команды'].'" alt="Логотип команды" class="img-thumbnail">
                        </div>
                        <div class="team_text col-12 col-md-8">';
                echo '<h3><a href="single.php?id='.$row['ID_Команды'].'">' .$row['Название'].'</a></h3>';
                echo '<p class="preview-text">Победы: '.$row["Кол_побед"].' Поражения: '.$row['Кол_поражений'].'</p>';
                echo '<p>'.$row['Название_конф'].' конференция</p>';
                echo '<p>Позиция в конференции - '.$row['Позиция_в_конф'].' Позиция в лиге - '.$row['Позиция_в_лиге'].'</p>';
                echo '<p>Штат: '.$row['Штат'].'</p>';
                echo '</div></div>';
            }
            ?>
        </div>

        <!--    sidebar-->
        <div class="sidebar col-md-4 col-12">
            <div class="section search">
                <h3>Поиск</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="search-term" placeholder="search">
                    <input style="margin-top: 10px" type="submit" class="btn-reg" value="Поиск">
                </form>
            </div>
        </div>
    </div>
</div>
<!--Main block end-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>
