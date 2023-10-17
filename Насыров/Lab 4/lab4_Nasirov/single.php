<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страница команды</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <?php
    include "database/connect.php";
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
            include "database/connect.php";
            $page = $_GET['id'];
            $result = 'Select *, Конференция.Название_конф from Команды 
    INNER JOIN Конференция ON (Команды.ID_Конференции = Конференция.ID_конф) WHERE ID_Команды ='.$page;
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            echo '<h2 style="color: #e1e1e1">'.$row['Название'].'</h2>';
            echo '<div class="team row">
                <div class="img col-12 col-md-4">
                     <img src="'.$row['Логотип_команды'].'" alt="Логотип команды" class="img-thumbnail">
                </div>';
            echo "<div style='background: cornflowerblue; border-radius: 5px; width: 60%' class='info col-12 col-md-8'>";
            echo '<p class="preview-text">Победы: '.$row["Кол_побед"].' Поражения: '.$row['Кол_поражений'].'</p>';
            echo '<p>Конференция - '.$row['Название_конф'].'</p>';
            echo '<p>Позиция в конференции - '.$row['Позиция_в_конф'].'</p><p>Позиция в лиге - '.$row['Позиция_в_лиге'].'</p>';
            echo '<p>Штат: '.$row['Штат'].'</p>';
            echo "</div>";
            ?>
            <h4>Состав команды</h4>
            <div class="single_team_text col-12">
                <?php
                include "database/connect.php";
                $res = "Select *, Команды.Название, Позиция.Название_поз from Игроки 
                        INNER JOIN Команды ON (Игроки.ID_Команды = Команды.ID_Команды)
                        INNER JOIN Позиция ON (Игроки.ID_Позиции = Позиция.ID_Позиции )
                                                 WHERE Команды.ID_Команды=".$page;
                $res = mysqli_query($conn, $res) or die("Ошибка запроса Select". mysqli_error($conn));
                if($res){
                    $table = "<center><table class='table_player' cellpadding='0' cellspacing='0'>
                                <tr><th>Имя</th><th>Фамилия</th><th>Поизция</th><th>Количество очков</th></tr>";
                    while($row = mysqli_fetch_assoc($res)){
                        $table .="<tr><td>".$row['Имя']."</td>
                                    <td>".$row['Фамилия']."</td>
                                    <td>".$row['Название_поз']."</td>
                                    <td>".$row['Кол_очков']."</td></tr>";
                    }
                    $table .= "</table></center>";
                    echo $table;
                }
                ?>
            </div>
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