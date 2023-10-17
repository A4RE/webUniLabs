<?php
include "vendor/connect.php";
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
include "components/header.php";
?>
<!--Main content-->
<div style="margin-top: 30px" class="container">
    <h2 style="color: #382f2f" align="center">Личный кабинет</h2>
    <div class="content row col-12 main-section">
        <div  style="border: #343496 1px solid; border-radius: 15px" class="info col-md-6 col-12 user-info">
            <?php
            if (isset($_SESSION['login'])) {
                echo "<p>Здравствуйте, " . $_SESSION['login'] . "</p>";
            }
            ?>
            <?php
            include "vendor/connect.php";
            $quer = "SELECT * FROM Пользователь WHERE `id_пользователя` = ".$_SESSION['id'];
            $checkUsers = mysqli_query($conn,$quer)or die("Ошибка запроса поиска" . mysqli_error($conn));
            $row = mysqli_fetch_assoc($checkUsers);
            $date_reg = strtotime($row['Дата_регистрации']);
            $new_date = date( 'd.m.Y H:i:s', $date_reg);
            echo "<p align='left'>ФИО: ".$row['ФИО_польз']."<br>
                                 Email: ".$row['email']."<br>
                                 Телефон: ".$row['телефон']."<br>
                                 Дата регистрации: ".$new_date."<br></p>";
            ?>
        </div>
        <div style="border: #343496 1px solid; border-radius: 15px" align="center" class="buttons col-md-6 col-12">
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
                echo "<h2 align='center' style='color: #e1e1e1'>Ваша Корзина</h2>";
                echo "<center><table class='table' cellspacing='0' cellpadding='0'>
                            <tr><th>Название мерча</th><th>Тип</th><th>Команда</th><th>Стоимость</th></tr>";
                foreach ($_SESSION['bas'] as $key => $value)
                {
                    $bas_qry = 'Select *, Команда.Название_команды from мерч INNER JOIN Команда ON (Мерч.id_команды = Команда.ID_Команды)
    where id_мерча='.$value;
                    $qry_res = mysqli_query($conn,$bas_qry)or die("Ошибка запроса поиска" . mysqli_error($conn));
                    $r = mysqli_fetch_assoc($qry_res);
                    echo "<tr><td>".$r['Название_мерч']."</td><td>".$r['Тип_мерча']."</td><td>".$r['Название_команды']."</td><td>".$r['Цена']."</td></tr>";
                }
                echo "</table></center>
                        <form method='post'><center>
                        <input style='width: 10%' class='btn-lk' type='submit' name='buy' value='Купить'>
                        <input style='width: 10%' class='btn-lk' type='submit' name='x' value='Закрыть'>
                        </center></form>";
            } else echo "<center><p><strong>Корзина пуста</strong></p></center>";
        } elseif (isset($_POST['buy']))
        {
            foreach ($_SESSION['bas'] as $key => $value)
            {
                $add = "Insert into Корзина (id_польз, id_мерч ) values ('".$_SESSION['id']."','".$value."')";
                $add = mysqli_query($conn,$add)or die("Ошибка запроса добавления" . mysqli_error($conn));
            }
            echo "<center><p><strong>Мерч заказан!</strong></p></center>";
            unset($_SESSION['bas']);
            header('Refresh: 3; URL = lk.php');

        } elseif (isset($_POST['hist']))
        {
            $qry_his = "Select COUNT(*) from Корзина where id_польз =".$_SESSION['id'];
            $his_res = mysqli_query($conn,$qry_his)or die("Ошибка запроса истории " . mysqli_error($conn));
            $rh = mysqli_fetch_row($his_res);
            echo "<center><strong><i>Ваша история покупок</i></strong></center>";
            echo '<form method="get">';
            if($rh[0] > 0)
            {
                $query = "SELECT *, Пользователь.ФИО_польз, мерч.Название_мерч FROM Корзина 
                            INNER JOIN Пользователь ON (Корзина.id_польз = Пользователь.id_пользователя) 
                            INNER JOIN мерч ON (Корзина.id_мерч = мерч.id_мерча) 
                                          WHERE Корзина.id_польз = ".$_SESSION['id'];
                $res_qry = mysqli_query($conn,$query)or die("Ошибка запроса истории 2" . mysqli_error($conn));
                echo '<center><table class="table"><tr><th>Номер Заказа</th><th>ФИО</th><th>Название</th><th>Тип</th><th>Стоимость (Р)</th><th>Дата Заказа</th></tr>';
                while ($row_h = mysqli_fetch_assoc($res_qry))
                {
                    $date_ist = strtotime($row_h['дата_заказа']);
                    $new_date_ist = date( 'd.m.Y H:i:s', $date_ist);
                    echo "<tr><td>".$row_h['id_заказа']."</td><td>".$row_h['ФИО_польз']."</td>
                          <td>".$row_h['Название_мерч']."</td><td>".$row_h['Тип_мерча']."</td><td>".$row_h['Цена']."</td><td>".$new_date_ist."</td></tr>";
                }
                echo "</table></center>";
            }
            else echo "<center><strong><i>У вас нет Заказов!</i></strong></center>";
        }
        ?>
    </div>
</div>

</body>
</html>



