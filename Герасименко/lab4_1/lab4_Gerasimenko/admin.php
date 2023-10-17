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
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
if(isset($_POST['add_Sotr'])){
    $sotrName = $_POST['NameSotr'];
    $dateBirth = strtotime($_POST['dateBirth']);
    $dateBirth = date('Y-m-d', $dateBirth);
    $id_dolz = $_POST['dolzList'];
    $oklad = $_POST['okladSotr'];
    $id_zoo = $_POST['zooList'];
    $add = "INSERT INTO `Сотрудник`(`ФИО`, `Дата_рожд`, `ID_должн`, `Оклад`, `ID_зоопарка`) 
            VALUES ('$sotrName','$dateBirth',$id_dolz,$oklad,$id_zoo)";
    $add = mysqli_query($conn, $add) or die ("Ошибка добавление". mysqli_error($conn));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
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
<div class="container">
    <h2 align="center">Админ панель</h2>
    <form method="get">
        <center>
            <input type="submit" class="btn-lk" name="exit" value="Выйти">
        </center>
    </form>
    <div class="row">
        <div class="col-md-6 m-auto">
            <form method="post">
                <div class="mb-3">
                    <p class="text-center fw-bold fs-3">Добавить сотрудника</p>
                    <label class="form-label">ФИО сотрудника</label>
                    <input type="text" name="NameSotr" class="form-control" placeholder="Введите ФИО">
                    <label class="form-label">Дата рождения</label>
                    <input type="date" name="dateBirth" class="form-control">
                    <label class="form-label">Должность</label>
                    <br>
                    <select name="dolzList" class="form-select">
                        <?php
                        $org = array();
                        $res_org = mysqli_query($conn, "SELECT `ID_Должности` FROM `Должности`") or die ("Ошибка ". mysqli_error($conn));
                        if($res_org){
                            while ($rs = mysqli_fetch_assoc($res_org)){
                                $org[]=array_values($rs);
                            }
                        }
                        foreach ($org as $key){
                            foreach ($key as $value){
                                echo '<option value="'.$value.'"'.($value == $_POST['dolzList'] ? ' selected="selected"' : '').'>'.$value.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <label class="form-label">Оклад</label>
                    <input type="number" name="okladSotr" class="form-control" placeholder="Оклад">
                    <label class="form-label">Зоопарк</label>
                    <br>
                    <select name="zooList" class="form-select">
                        <?php
                        $org = array();
                        $res_org = mysqli_query($conn, "SELECT `ID_зоопарка` FROM `Зоопарк`") or die ("Ошибка ". mysqli_error($conn));
                        if($res_org){
                            while ($rs = mysqli_fetch_assoc($res_org)){
                                $org[]=array_values($rs);
                            }
                        }
                        foreach ($org as $key){
                            foreach ($key as $value){
                                echo '<option value="'.$value.'"'.($value == $_POST['zooList'] ? ' selected="selected"' : '').'>'.$value.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <center>
                    <input style="width: 90%" type="submit" name="add_Sotr" class="btn btn-lk" value="Добавить">
                </center>
            </form>
        </div>
        <div class="col-md-3 m-auto">
            <table class="table">
                <thead>
                <th>ID должности</th>
                <th>Название должности</th>
                </thead>
                <tbody>
                <?php
                $qry = mysqli_query($conn, "SELECT * FROM `Должности`") or die ("Ошибка ". mysqli_error($conn));
                while ($row_sotr= mysqli_fetch_assoc($qry)){
                    echo '<tr>
                            <td>'.$row_sotr['ID_Должности'].'</td>
                            <td>'.$row_sotr['Назв_должн'].'</td>
                          </tr>';;
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table">
                <thead>
                <th>ID зоопарка</th>
                <th>Название зоопарка</th>
                </thead>
                <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM `Зоопарк`") or die ("Ошибка ". mysqli_error($conn));
                while ($row_sotr= mysqli_fetch_assoc($q)){
                    echo '<tr>
                            <td>'.$row_sotr['ID_зоопарка'].'</td>
                            <td>'.$row_sotr['Назв_зпарка'].'</td>
                          </tr>';;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-8 m-auto">
            <h2 align="center">Список сотрудников</h2>
            <form method="post">
                <table class="table">
                    <thead>
                    <th>ID сотрудника</th>
                    <th>ФИО</th>
                    <th>Дата рождения</th>
                    <th>Должность</th>
                    <th>Оклад (Р)</th>
                    <th>Зоопарк</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT *, `Зоопарк`.*, `Должности`.* FROM `Сотрудник` 
                                INNER JOIN `Зоопарк` ON (`Сотрудник`.`ID_зоопарка` = `Зоопарк`.`ID_зоопарка`)
                                INNER JOIN `Должности` ON (`Сотрудник`.`ID_должн` = `Должности`.`ID_Должности`)";
                    $query = mysqli_query($conn, $query) or die ("Ошибка ". mysqli_error($conn));
                    while ($row_sotr= mysqli_fetch_assoc($query)){
                        $date_birth = strtotime($row_sotr['Дата_рожд']);
                        $date_birth = date("d.m.Y", $date_birth);
                        echo '<tr>
                            <td>'.$row_sotr['ID_сотр'].'</td>
                            <td>'.$row_sotr['ФИО'].'</td>
                            <td>'.$date_birth.'</td>
                            <td>'.$row_sotr['Назв_должн'].'</td>
                            <td>'.$row_sotr['Оклад'].'</td>
                            <td>'.$row_sotr['Назв_зпарка'].'</td>
                            <td><a href="update.php?id='.$row_sotr['ID_сотр'].'" class="btn btn-warning">Update</td>
                            <td><a href="delete.php?id='.$row_sotr['ID_сотр'].'" class="btn btn-danger">Delete</td>
                          </tr>';;
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>