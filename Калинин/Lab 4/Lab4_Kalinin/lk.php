<?php
include "connect.php";
session_start();
unset($_SESSION['message']);
if(isset($_GET['exit']))
{
    session_destroy();
    header('Location: index.php');
    exit;
}
if(!isset($_SESSION['id'])){
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<?php
include "header.php";
?>
<!--Main content-->
<div style="margin-top: 30px" class="container">
    <h2 align="center">Личный кабинет клиента</h2>
    <div class="content row col-12 main-section">
        <div class="info col-md-6 col-12 user-info">
            <?php
            if (isset($_SESSION['login'])) {
                echo "<p>Добро пожаловать, " . $_SESSION['login'] . "</p>";
            }
            ?>
            <?php
            include "connect.php";
            $quer = "SELECT * FROM Клиент WHERE `ID_клиента` = ".$_SESSION['id'];
            $checkUsers = mysqli_query($conn,$quer)or die("Ошибка запроса поиска" . mysqli_error($conn));
            $row = mysqli_fetch_assoc($checkUsers);
            $date_reg = strtotime($row['Дата_регистрации']);
            $new_date = date( 'd.m.Y H:i:s', $date_reg);
            echo "<p style='left: 0'>ФИО: ".$row['ФИО']."<br>
                                 Email: ".$row['email']."<br>
                                 Дата и время регистрации: ".$new_date."<br></p>";
            ?>
        </div>
        <div align="center" class="buttons col-md-6 col-12">
            <form method="post">
                <input type="submit" name="hist" class="btn-lk" value="История Заказов">
                <input type="submit" name="bas" class="btn-lk" value="Корзина">
            </form>
            <?php
            echo '<form  metod="get"><input type="submit" class="btn-lk" name="exit" value="Выход"><br></form>';
            ?>
        </div>
    </div>
    <div class="vivod">
        <?php
        if(isset($_POST['bas'])){
            if(isset($_SESSION['bas']))
            {
                echo "<h2>Ваша Корзина</h2>";
                echo "<center><table class='table' cellspacing='0' cellpadding='0'>";
                foreach ($_SESSION['bas'] as $key => $value)
                {
                    $bas_qry = 'Select *, Видеокарты.*, Материнская_плата.*, 
                                 Память_ОЗУ.*, Память_ПЗУ.*, Процессоры.*, 
                                 Программное_обеспечение.*, Тип_сборки.* from системный_блок 
                                 INNER JOIN Видеокарты on (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты )
                                INNER JOIN Материнская_плата on (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
                                 INNER JOIN Память_ОЗУ on (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
                                 INNER JOIN Память_ПЗУ on (системный_блок.ID_пам_ПЗУ =Память_ПЗУ.ID_ПЗУ)
                                 INNER JOIN Процессоры on (системный_блок.ID_процессора = Процессоры.ID_процессора)
                                 INNER JOIN Программное_обеспечение on (системный_блок.ID_по = Программное_обеспечение.ID_ПО)
                                 INNER JOIN Тип_сборки on (системный_блок.ID_типа = Тип_сборки.id_типа) where ID_сис_блока ='.$value;
                    $qry_res = mysqli_query($conn,$bas_qry)or die("Ошибка запроса поиска" . mysqli_error($conn));
                    $r = mysqli_fetch_assoc($qry_res);
                    echo "<tr><td><img style='width: 150px; height: 200px' src='".$r['Изображение_сборки']."'alt='изображение сборки'></td>
                              <td><p>Видеокарта: ".$r['Фирма_видеокарты']." ".$r['Серия_видеокарты']."<br>
                              ОЗУ: ".$r['Тип_ОЗУ']."<br>
                              ПЗУ: ".$r['Тип_ПЗУ']." ".$r['Фирма_ПЗУ']." ".$r['Размер_ПЗУ']."<br>
                              Процессор: ".$r['Фирма_процессора']." ".$r['Серия_процессора']." ".$r['Процессор']."<br>
                              ПО: ".$r['Тип_ПО']."<br>
                              Тип сборки: ".$r['Наименование_типа']."<br>
                              Цена: ".$r['Цена']."</p></td></tr>";
                }
                echo "</table></center>
                        <form method='post'><center>
                        <input class='btn-lk' type='submit' name='buy' value='Заказать'>
                        <input class='btn-lk' type='submit' name='x' value='Закрыть'>
                        </center></form>";
            } else echo "<center><p><strong>Корзина пуста</strong></p></center>";
        } elseif (isset($_POST['buy']))
        {
            foreach ($_SESSION['bas'] as $key => $value)
            {
                $add = "INSERT INTO Корзина (id_клиента, ID_Сборки) VALUES ('".$_SESSION['id']."', '".$value."')";
                $add = mysqli_query($conn,$add)or die("Ошибка запроса добавления" . mysqli_error($conn));
            }
            echo "<center><p><strong>Заказ успешно оформлен!</strong></p></center>";
            unset($_SESSION['bas']);
            header('Refresh: 3; URL = lk.php');

        } elseif (isset($_POST['hist']))
        {
            $qry_his = "Select COUNT(*) from Корзина where ID_Клиента=".$_SESSION['id'];
            $his_res = mysqli_query($conn,$qry_his)or die("Ошибка запроса истории " . mysqli_error($conn));
            $rh = mysqli_fetch_row($his_res);
            echo "<center><strong><i>Ваша история заказов</i></strong></center>";
            echo '<form method="get">';
            if($rh[0] > 0)
            {
                $query = "SELECT *, Клиент.ФИО,  системный_блок.*, Видеокарты.*, Материнская_плата.*, 
                                 Память_ОЗУ.*, Память_ПЗУ.*, Процессоры.*, 
                                 Программное_обеспечение.*, Тип_сборки.* FROM Корзина 
                                 INNER JOIN Клиент ON (Корзина.ID_Клиента  = Клиент.ID_Клиента) 
                                 INNER JOIN системный_блок ON (Корзина.ID_Сборки = системный_блок.ID_сис_блока)
                                 INNER JOIN Видеокарты on (системный_блок.ID_видеокарты = Видеокарты.ID_видеокарты )
                                 INNER JOIN Материнская_плата on (системный_блок.ID_матплаты = Материнская_плата.ID_матплаты)
                                 INNER JOIN Память_ОЗУ on (системный_блок.ID_пам_ОЗУ = Память_ОЗУ.ID_ОЗУ)
                                 INNER JOIN Память_ПЗУ on (системный_блок.ID_пам_ПЗУ =Память_ПЗУ.ID_ПЗУ)
                                 INNER JOIN Процессоры on (системный_блок.ID_процессора = Процессоры.ID_процессора)
                                 INNER JOIN Программное_обеспечение on (системный_блок.ID_по = Программное_обеспечение.ID_ПО)
                                 INNER JOIN Тип_сборки on (системный_блок.ID_типа = Тип_сборки.id_типа)
                                 WHERE Корзина.ID_Клиента = ".$_SESSION['id'];
                $res_qry = mysqli_query($conn,$query)or die("Ошибка запроса истории 2" . mysqli_error($conn));
                echo '<center><table class="table">';
                while ($row_h = mysqli_fetch_assoc($res_qry))
                {
                    $date_ist = strtotime($row_h['Дата_заказа']);
                    $new_date_ist = date( 'd F Y', $date_ist);
                    $time = date('H:i', $date_ist);
                    echo "<tr><td>Номер заказа: ".$row_h['ID_заказа']."</td><td><img src='".$row_h['Изображение_сборки']."'alt='изображение сборки'></td>
                              <td><p>Видеокарта: ".$row_h['Фирма_видеокарты']." ".$row_h['Серия_видеокарты']."<br>
                              ОЗУ: ".$row_h['Тип_ОЗУ']."<br>
                              ПЗУ: ".$row_h['Тип_ПЗУ']." ".$row_h['Фирма_ПЗУ']." ".$row_h['Размер_ПЗУ']."<br>
                              Процессор: ".$row_h['Фирма_процессора']." ".$row_h['Серия_процессора']." ".$row_h['Процессор']."<br>
                              ПО: ".$row_h['Тип_ПО']."<br>
                              Тип сборки: ".$row_h['Наименование_типа']."<br>
                              Цена: ".$row_h['Цена']."</p></td><td><p>Дата заказа: ".$new_date_ist." в ".$time."</p></td></tr>";
                }
                echo "</table></center>";
            }
            else echo "<center><strong><i>У вас нет Заказов!</i></strong></center>";
        }
        ?>
    </div>
</div>
<?php
include "footer.php";
?>
</body>
</html>




