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
include "components/header.php";
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
            $result = 'Select * from Команда WHERE ID_Команды ='.$page;
            $result = mysqli_query($conn, $result) or die("Ошибка запроса Select". mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);
            echo '<h2>'.$row['Название_команды'].'</h2>';
            echo '<div class="team row">
                    <div class="img col-12 col-md-4">
                     <img style="width: 100%; height: 300px" src="'.$row['Логотип_команды'].'" alt="Логотип команды" class="img-thumbnail">
                    </div>';
            echo "<div class='info col-12 col-md-8'>";
            echo '<p class="preview-text">Победы: '.$row["Кол_побед"].'</p><p>Поражения: '.$row['Кол_поражений'].'</p>';
            echo '<p>Город: '.$row['Город'].'</p>';
            echo '</div>
                  </div>';
            ?>
            <h4>Состав команды</h4>
            <div class="single_team_text col-12 row">
                <?php
                include "vendor/connect.php";
                $res = "Select *, Команда.Название_команды from Игрок 
                        INNER JOIN Команда ON (Игрок.ID_Команды = Команда.ID_Команды)
                                                 WHERE Команда.ID_Команды=".$page;
                $res = mysqli_query($conn, $res) or die("Ошибка запроса Select". mysqli_error($conn));
                while($row = mysqli_fetch_assoc($res)){
                    echo '<div style="text-align: center" class="single_team_text col-md-4">
                            <div class="img">
                                <img style="width: 80%; height: 250px" src="'.$row['Фото_игрока'].'" alt="Фотография игрока" class="img-thumbnail">
                            </div>';
                    echo '<p>'.$row['Имя'].' '.$row['Фамилия'].'</p>';
                    echo '<p>Количество голов: '.$row['Кол_Голов'].'</p>';
                    echo '</div>';
                }
                ?>
            </div>
            <h4>Статистика команды</h4>
            <div style="margin-bottom: 10px" class="table_statistics">
                <?php
                include "vendor/connect.php";
                $res_st = "Select *, Команда.* from Игра INNER JOIN 
                        Команда on (Игра.ID_Команды = Команда.ID_Команды) 
                        where Игра.ID_Команды=".$page;
                $res_st = mysqli_query($conn, $res_st) or die("Ошибка запроса Select". mysqli_error($conn));
                if($res_st){
                    $table = '<center><table class="table_statistic" cellspacing="0" cellpadding="0">
                    <tr><th>Номер игры</th><th>Количество голов</th><th>Броски в створ</th><th>Дата игры</th></tr>';
                    while ($row_st=mysqli_fetch_assoc($res_st))
                    {
                        $date_game = strtotime($row_st['Дата_Игры']);
                        $date_game = date('d F Y', $date_game);
                        $table .='<tr><td>'.$row_st['ID_Игры'].'</td>
                                      <td>'.$row_st['Кол_Голов'].'</td>
                                      <td>'.$row_st['Броски_по_Воротам'].'</td>
                                      <td>'.$date_game.'</td></tr>';
                    }
                    $table .= "</table></center>";
                    echo $table;
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
