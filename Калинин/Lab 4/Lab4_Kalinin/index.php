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
            <h2>Добро пожаловать на наш сайт</h2>
            <p>На нашем сайте вы можете посмотреть сборки компьютеров и заказать понравившуюся вам сборку в пункте - купить.<br>
            Ниже представлены сборки ПК</p>
        </div>
        <div class="main-content row justify-content-center col-md-12">
            <?php
            include "connect.php";
            $result = 'Select *, Видеокарты.*, Материнская_плата.*, 
                                 Память_ОЗУ.*, Память_ПЗУ.*, Процессоры.*, 
                                 Программное_обеспечение.*, Тип_сборки.* from системный_блок 
                                 INNER JOIN Видеокарты on (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты )
                                 INNER JOIN Материнская_плата on (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
                                 INNER JOIN Память_ОЗУ on (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
                                 INNER JOIN Память_ПЗУ on (системный_блок.ID_пам_ПЗУ =Память_ПЗУ.ID_ПЗУ)
                                 INNER JOIN Процессоры on (системный_блок.ID_процессора = Процессоры.ID_процессора)
                                 INNER JOIN Программное_обеспечение on (системный_блок.ID_по = Программное_обеспечение.ID_ПО)
                                 INNER JOIN Тип_сборки on (системный_блок.ID_типа = Тип_сборки.id_типа)';
            $result = mysqli_query($conn, $result) or die("Ошибка запроса ".mysqli_error($conn));
            while ($row = mysqli_fetch_assoc($result))
            {
                echo '<div class="sborka col-12 col-md-4">';
                echo '<div class="sborka_img col-12 col-md-12">
                        <img src="'.$row['Изображение_сборки'].'" alt="Картинка сборки">
                       </div>
                       <p style="margin-top: 10px">Видеокарта: '.$row['Фирма_видеокарты'].' '.$row['Серия_видеокарты'].'<br>
                          Матплата: '.$row['Тип_матплаты'].' '.$row['Фирма_матплаты'].' '.$row['Сокет_матплаты'].'<br>
                          ОЗУ: '.$row['Тип_ОЗУ'].'<br>
                          ПЗУ: '.$row['Тип_ПЗУ'].' '.$row['Фирма_ПЗУ'].' '.$row['Размер_ПЗУ'].'<br>
                          Процессор: '.$row['Фирма_процессора'].' '.$row['Серия_процессора'].' '.$row['Процессор'].'<br>
                          ПО: '.$row['Тип_ПО'].'<br>
                          Тип сборки: '.$row['Наименование_типа'].'<br>
                          Цена: '.$row['Цена'].'<br>
                          </p>
                          <form action="sborka.php">
                          <input type="submit" value="Заказать" class="btn btn-lk">
                          </form>
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

