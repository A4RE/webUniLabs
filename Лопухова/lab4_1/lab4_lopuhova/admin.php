<?php
include "base/setup.php";
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
if(isset($_POST['add_vistavka'])){
    $vistName = $_POST['VName'];
    $vistStartDate = $_POST['DateStart'];
    $vistEndtDate = $_POST['DateEnd'];
    $vistAdres = $_POST['VAdres'];
    $vistOrg = $_POST['VOrgList'];

    $vistStartDate = strtotime($_POST['DateStart']);
    $vistEndtDate = strtotime($_POST['DateEnd']);
    $vistStartDate = date('Y-m-d', $vistStartDate);
    $vistEndDate = date('Y-m-d', $vistEndtDate);
    //Добавление выставки в БД
    $addVist = "INSERT INTO `Выставка`(`Название`, `Дата_начала`, `Дата_окончания`, `Адрес`, `id_организатора`)
                VALUES ('$vistName', '$vistStartDate', '$vistEndDate', '$vistAdres', $vistOrg)";
    $addVist = mysqli_query($conn, $addVist) or die ("Ошибка добавление". mysqli_error($conn));
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

    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<?php
include "components/header.php";
?>
<!--Main content-->
<div style="margin-top: 30px" class="container">
    <h2 align="center">Личный кабинет</h2>
    <form method="get">
        <center>
        <input type="submit" class="btn-lk" value="Выйти" name="exit">
        </center>
    </form>
    <div class="row">
        <div class="col-md-6 m-auto border">
            <form method="post">
                <div class="mb-3">
                    <p class="text-center fw-bold fs-3 text-warning">Добавить выставку</p>
                    <label class="form-label">Название выставки</label>
                    <input type="text" name="VName" class="form-control" placeholder="Введите название выставки">
                    <label class="form-label">Дата начала события</label>
                    <input type="date" name="DateStart" class="form-control">
                    <label class="form-label">Дата окончания события</label>
                    <input type="date" name="DateEnd" class="form-control">
                    <label class="form-label">Адрес выставки</label>
                    <input type="text" name="VAdres" class="form-control" placeholder="Введите адрес выставки">
                    <label class="form-label">Организатор</label>
                    <br>
                    <select name="VOrgList" class="form-select">
                        <?php
                        $org = array();
                        $res_org = mysqli_query($conn, "SELECT `id_организатора` FROM `Организатор`") or die ("Ошибка ". mysqli_error($conn));
                        if($res_org){
                            while ($rs = mysqli_fetch_assoc($res_org)){
                                $org[]=array_values($rs);
                            }
                        }
                        foreach ($org as $key){
                            foreach ($key as $value){
                                echo '<option value="'.$value.'"'.($value == $_POST['VOrgList'] ? ' selected="selected"' : '').'>'.$value.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <center>
                <input style="width: 90%" type="submit" name="add_vistavka" class="btn btn-lk" value="Добавить">
                </center>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post">
                <table class="table">
                    <thead>
                    <th>ID</th>
                    <th>Название выставки</th>
                    <th>Дата начала</th>
                    <th>Дата окончания</th>
                    <th>Адрес</th>
                    <th>Организатор</th>
                    <th>Изменить</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT *, `Организатор`.* FROM `Выставка` INNER JOIN `Организатор` ON (`Выставка`.`id_организатора` = `Организатор`.`id_организатора`)";
                    $query = mysqli_query($conn, $query) or die ("Ошибка ". mysqli_error($conn));
                    while ($row_vist= mysqli_fetch_assoc($query)){
                        $dateStart = strtotime($row_vist['Дата_начала']);
                        $dateEnd = strtotime($row_vist['Дата_окончания']);
                        $dateStart = date("d.m.Y", $dateStart);
                        $dateEnd = date("d.m.Y", $dateEnd);
                        echo '<tr>
                            <td>'.$row_vist['id_выставки'].'</td>
                            <td>'.$row_vist['Название'].'</td>
                            <td>'.$dateStart.'</td>
                            <td>'.$dateEnd.'</td>
                            <td>'.$row_vist['Адрес'].'</td>
                            <td>'.$row_vist['ФИО_Организатора'].'</td>
                            <td><a href="update.php?id='.$row_vist['id_выставки'].'" class="btn btn-warning">Update</td>
                            <td><a href="delete.php?id='.$row_vist['id_выставки'].'" class="btn btn-danger">Delete</td>
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

