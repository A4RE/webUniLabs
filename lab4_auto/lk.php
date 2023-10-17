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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


</head>
<body>
<?php
include "header.php";
?>
<!--Main section-->
<center>
    <div class="container">
        <div class="lk-content">
            <h2 align="center">Личный кабинет</h2>
        </div>
        <div class="lk">
            <?php
            if(isset($_SESSION['login']))
            {
                echo "<p>Здравствуйте, ".$_SESSION['login']."</p>";
            }
            ?>
        </div>
        <div class="info">
            <?php
            include "connect.php";
            $quer = "SELECT * FROM Клиент WHERE `id_клиента` = ".$_SESSION['id'];
            $checkUsers = mysqli_query($conn,$quer)or die("Ошибка запроса поиска" . mysqli_error($conn));
            $row = mysqli_fetch_assoc($checkUsers);
            $date_reg = strtotime($row['дата_регистрации']);
            $new_date = date( 'd.m.Y H:i:s', $date_reg);
            echo "<p>ФИО: ".$row['ФИО']."<br>
                         Email: ".$row['email']."<br
                         Телефон: ".$row['Телефон']."<br>  
                         Дата регистрации: ".$new_date."<br></p>";
            ?>
        </div>
        <div class="buttons row">
            <form method="post">
                <input type="submit" name="hist" class="btn-lk" value="История Заказов">
                <input type="submit" name="bas" class="btn-lk" value="Корзина">
            </form>
            <?php
            echo '<form  metod="get"><input type="submit" class="btn-lk" name="exit" value="Выход"><br></form>';
            ?>
        </div>
        <div class="vivod">
            <?php
            if(isset($_POST['bas'])){
                if(isset($_SESSION['bas']))
                {
                    echo "<h2 align='center'>Ваша Корзина</h2>";
                    echo "<center><table class='table' cellspacing='0' cellpadding='0'>
                            <tr><th>Услуга</th><th>Цена</th></tr>";
                    foreach ($_SESSION['bas'] as $key => $value)
                    {
                        $bas_qry = 'Select * from Услуга where id_услуги='.$value;
                        $qry_res = mysqli_query($conn,$bas_qry)or die("Ошибка запроса поиска" . mysqli_error($conn));
                        $r = mysqli_fetch_assoc($qry_res);
                        echo "<tr><td>".$r['Наименование_услуги']."</td><td>".$r['Стоимость_услуги']."</td></tr>";
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
                    $add = "Insert into Корзина (id_клиента, id_услуги) values ('".$_SESSION['id']."','".$value."')";
                    $add = mysqli_query($conn,$add)or die("Ошибка запроса добавления" . mysqli_error($conn));
                }
                echo "<center><p><strong>Услуга успешно заказана!</strong></p></center>";
                unset($_SESSION['bas']);
                header('Refresh: 3; URL = lk.php');

            } elseif (isset($_POST['hist']))
            {
                $qry_his = "Select COUNT(*) from Корзина where id_клиента=".$_SESSION['id'];
                $his_res = mysqli_query($conn,$qry_his)or die("Ошибка запроса истории " . mysqli_error($conn));
                $rh = mysqli_fetch_row($his_res);
                echo "<center><strong><i>Ваша история покупок</i></strong></center>";
                echo '<form method="get">';
                if($rh[0] > 0)
                {
                    $query = "SELECT *, Клиент.ФИО, Услуга.Наименование_услуги FROM Корзина 
                            INNER JOIN Клиент ON (Корзина.id_клиента = Клиент.id_клиента) 
                            INNER JOIN Услуга ON (Корзина.id_услуги = Услуга.id_услуги) 
                                          WHERE Корзина.id_клиента = ".$_SESSION['id'];
                    $res_qry = mysqli_query($conn,$query)or die("Ошибка запроса истории 2" . mysqli_error($conn));
                    echo '<center><table class="table"><tr><th>Номер Заказа</th><th>ФИО</th><th>Услуга</th><th>Стоимость</th><th>Дата Заказа</th></tr>';
                    while ($row_h = mysqli_fetch_assoc($res_qry))
                    {
                        $date_ist = strtotime($row_h['дата_услуги']);
                        $new_date_ist = date( 'd.m.Y H:i:s', $date_ist);
                        echo "<tr><td>".$row_h['id_заказа']."</td><td>".$row_h['ФИО']."</td>
                          <td>".$row_h['Наименование_услуги']."</td><td>".$row_h['Стоимость_услуги']."</td><td>".$new_date_ist."</td></tr>";
                    }
                    echo "</table></center>";
                }
                else echo "<center><strong><i>У вас нет Заказов!</i></strong></center>";
            }
            ?>
        </div>
    </div>
</center>
</body>
</html>

