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
    header("Location: login_admin.php");
}
if(isset($_POST['add_acia'])){
    $aciaName = $_POST['AciaName'];
    $aciaCafe = $_POST['cafeList'];
    $aciaOpis = $_POST['AciaOpis'];
    $aciaType = $_POST['AciaType'];
    $aciaStartDate = $_POST['DateStart'];
    $aciaEndDate = $_POST['DateEnd'];

    $vistStartDate = strtotime($_POST['DateStart']);
    $vistEndtDate = strtotime($_POST['DateEnd']);
    $vistStartDate = date('Y-m-d', $vistStartDate);
    $vistEndDate = date('Y-m-d', $vistEndtDate);
    $add = "INSERT INTO `Событие`(`Название_события`, `id_кафе`, `Описание`, `Тип`, `Начало_акции`, `Конец_акции`) 
            VALUES ('$aciaName',$aciaCafe,'$aciaOpis','$aciaType','$aciaStartDate','$aciaEndDate')";
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
                    <p class="text-center fw-bold fs-3">Добавить акцию</p>
                    <label class="form-label">Название акции</label>
                    <input type="text" name="AciaName" class="form-control" placeholder="Введите название акции">
                    <label class="form-label">Кафе</label>
                    <br>
                    <select name="cafeList" class="form-select">
                        <?php
                        $org = array();
                        $res_org = mysqli_query($conn, "SELECT `ID_кафе` FROM `Кафе`") or die ("Ошибка ". mysqli_error($conn));
                        if($res_org){
                            while ($rs = mysqli_fetch_assoc($res_org)){
                                $org[]=array_values($rs);
                            }
                        }
                        foreach ($org as $key){
                            foreach ($key as $value){
                                echo '<option value="'.$value.'"'.($value == $_POST['cafeList'] ? ' selected="selected"' : '').'>'.$value.'</option>';
                            }
                        }
                        ?>
                    </select>
                    <label class="form-label">Описание акции</label>
                    <input type="text" name="AciaOpis" class="form-control" placeholder="Введите описание акции">
                    <label class="form-label">Тип</label>
                    <input type="text" name="AciaType" class="form-control" placeholder="Введите тип">
                    <label class="form-label">Дата начала события</label>
                    <input type="date" name="DateStart" class="form-control">
                    <label class="form-label">Дата окончания события</label>
                    <input type="date" name="DateEnd" class="form-control">
                </div>
                <center>
                    <input style="width: 90%" type="submit" name="add_acia" class="btn btn-lk" value="Добавить">
                </center>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 m-auto">
            <h2 align="center">Список событий</h2>
            <form method="post">
                <table class="table">
                    <thead>
                    <th>ID</th>
                    <th>Название события</th>
                    <th>Адрес кафе</th>
                    <th>Описание</th>
                    <th>Тип</th>
                    <th>Начало акции</th>
                    <th>Конец акции</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT *, `Кафе`.* FROM `Событие` INNER JOIN `Кафе` ON (`Событие`.`id_кафе` = `Кафе`.`ID_кафе`)";
                    $query = mysqli_query($conn, $query) or die ("Ошибка ". mysqli_error($conn));
                    while ($row_sobit= mysqli_fetch_assoc($query)){
                        $dateStart = strtotime($row_sobit['Начало_акции']);
                        $dateEnd = strtotime($row_sobit['Конец_акции']);
                        $dateStart = date("d.m.Y", $dateStart);
                        $dateEnd = date("d.m.Y", $dateEnd);
                        echo '<tr>
                            <td>'.$row_sobit['id_события'].'</td>
                            <td>'.$row_sobit['Название_события'].'</td>
                            <td>'.$row_sobit['Адрес'].'</td>
                            <td>'.$row_sobit['Описание'].'</td>
                            <td>'.$row_sobit['Тип'].'</td>
                            <td>'.$dateStart.'</td>
                            <td>'.$dateEnd.'</td>
                            <td><a href="update.php?id='.$row_sobit['id_события'].'" class="btn btn-warning">Update</td>
                            <td><a href="delete.php?id='.$row_sobit['id_события'].'" class="btn btn-danger">Delete</td>
                          </tr>';;
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 m-auto">
            <h2 align="center">Список сотрудников</h2>
            <form method="post">
                <table class="table">
                    <thead>
                    <th>ID сотрудника</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Телефон</th>
                    <th>Паспорт</th>
                    <th>Кафе</th>
                    <th>Должность</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>
                    <?php
                    $q = "SELECT *, `Кафе`.*, `Должность`.* FROM `Сотрудник` 
                                INNER JOIN `Кафе` ON (`Сотрудник`.`ID_кафе` = `Кафе`.`ID_кафе`)
                                INNER JOIN `Должность` ON (`Сотрудник`.`ID_Должности` = `Должность`.`ID_Должности`)";
                    $q = mysqli_query($conn, $q) or die ("Ошибка ". mysqli_error($conn));
                    while ($row_sotr= mysqli_fetch_assoc($q)){
                        echo '<tr>
                            <td>'.$row_sotr['ID_Сотрудника'].'</td>
                            <td>'.$row_sotr['Фамилия'].'</td>
                            <td>'.$row_sotr['Имя'].'</td>
                            <td>'.$row_sotr['Отчество'].'</td>
                            <td>'.$row_sotr['Телефон'].'</td>
                            <td>'.$row_sotr['Паспорт'].'</td>
                            <td>'.$row_sotr['Адрес'].'</td>
                            <td>'.$row_sotr['Название'].'</td>
                            <td><a href="update_sotr.php?id='.$row_sotr['ID_Сотрудника'].'" class="btn btn-warning">Update</td>
                            <td><a href="delete_sotr.php?id='.$row_sotr['ID_Сотрудника'].'" class="btn btn-danger">Delete</td>
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