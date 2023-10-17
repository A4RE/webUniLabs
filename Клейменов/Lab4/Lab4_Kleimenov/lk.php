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
    header("Location: auth.php");
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
    <h2 align="center">Добро пожаловать в личный кабинет</h2>
    <div class="content row col-12 main-section">
        <div class="info col-md-12 col-12 user-info">
            <?php
            include "connect.php";
            $quer = "SELECT * FROM Клиент WHERE `id_клиента` = ".$_SESSION['id'];
            $checkUsers = mysqli_query($conn,$quer)or die("Ошибка запроса поиска" . mysqli_error($conn));
            $row = mysqli_fetch_assoc($checkUsers);
            $date_reg = strtotime($row['Дата_регистрации']);
            $new_date = date( 'd.m.Y', $date_reg);
            echo "<p style='left: 0'>ФИО: ".$row['ФИО']."<br>
                                 Email: ".$row['email']."<br>
                                 Телефон: ".$row['Телефон']."<br>
                                 Дата регистрации: ".$new_date."<br></p>";
            ?>
        </div>
        <div align="center" class="buttons col-md-12 col-12">
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
                echo '<div class="vivod_inf">';
                echo "<h2>Ваша Корзина</h2>";
                echo "<center><table class='table'><tr><th>Фото Макета</th><th>Макет</th><th>Фундамент</th><th>Материал</th><th>Стоимость (Р)</th></tr>";
                foreach ($_SESSION['bas'] as $key => $value)
                {
                    $bas_qry = 'SELECT *, Макет.*, материал.название_материала, Фундамент.Тип FROM Услуга 
                            INNER JOIN Макет on (Услуга.id_макета = Макет.id_макета)
                            INNER JOIN материал on (Услуга.id_материала = материал.id_материала)
                            INNER JOIN Фундамент on (Услуга.id_фундамента = Фундамент.id_фундамента) where id_услуги ='.$value;
                    $qry_res = mysqli_query($conn,$bas_qry)or die("Ошибка запроса поиска" . mysqli_error($conn));
                    $r = mysqli_fetch_assoc($qry_res);
                    echo "<tr><td><img src='".$r['Фото']."' alt='Фото шаблона'></td><td>".$r['Название_макета']."</td>
                    <td>".$r['Тип']."</td><td>".$r['название_материала']."</td><td>".$r['Стоимость_услуги']."</td></tr>";
                }
                echo "</table></center>
                        <form method='post'><center>
                        <input class='btn-lk' type='submit' name='buy' value='Заказать'>
                        <input class='btn-lk' type='submit' name='x' value='Закрыть'>
                        </center></form></div>";
            } else echo "<center><p><strong>Корзина пуста</strong></p></center>";
        } elseif (isset($_POST['buy']))
        {
            foreach ($_SESSION['bas'] as $key => $value)
            {
                $add = "INSERT INTO Корзина (id_клиента, id_услуги) VALUES ('".$_SESSION['id']."', '".$value."')";
                $add = mysqli_query($conn,$add)or die("Ошибка запроса добавления" . mysqli_error($conn));
            }
            echo "<center><p><strong>Заказ успешно оформлен, мы перезвоним вам в течение 5 минут для уточнения деталей!</strong></p></center>";
            unset($_SESSION['bas']);
            header('Refresh: 3; URL = lk.php');

        } elseif (isset($_POST['hist']))
        {
            $qry_his = "Select COUNT(*) from Корзина where id_клиента=".$_SESSION['id'];
            $his_res = mysqli_query($conn,$qry_his)or die("Ошибка запроса истории " . mysqli_error($conn));
            $rh = mysqli_fetch_row($his_res);
            echo "<center><strong><i>Ваша история заказов</i></strong></center>";
            echo '<form method="get">';
            if($rh[0] > 0)
            {
                $query = "SELECT *, Клиент.ФИО, Услуга.*, Макет.*, материал.название_материала, Фундамент.Тип FROM Корзина 
                            INNER JOIN Клиент ON (Корзина.id_клиента = Клиент.id_клиента) 
                            INNER JOIN Услуга ON (Корзина.id_услуги = Услуга.id_услуги)
                            INNER JOIN Макет on (Услуга.id_макета = Макет.id_макета)
                            INNER JOIN материал on (Услуга.id_материала = материал.id_материала)
                            INNER JOIN Фундамент on (Услуга.id_фундамента  = Фундамент.id_фундамента)
                                          WHERE Корзина.id_клиента = ".$_SESSION['id'];
                $res_qry = mysqli_query($conn,$query)or die("Ошибка запроса истории 2" . mysqli_error($conn));
                echo '<div class="vivod_inf">';
                echo "<center><table class='table'><tr><th>Номер заказа</th><th>Макет</th><th>Фундамент</th><th>Материал</th><th>Стоимость (Р)</th><th>Дата заказа</th></tr>";
                while ($row_h = mysqli_fetch_assoc($res_qry))
                {
                    $date_ist = strtotime($row_h['Дата_заказа']);
                    $new_date_ist = date( 'd.m.Y H:i:s', $date_ist);
                    echo "<tr><td>".$row_h['id_заказа']."</td><td>".$row_h['Название_макета']."</td>
                    <td>".$row_h['Тип']."</td><td>".$row_h['название_материала']."</td><td>".$row_h['Стоимость_услуги']."</td><td>".$new_date_ist."</td></tr>";
                }
                echo "</table></center></div>";
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




