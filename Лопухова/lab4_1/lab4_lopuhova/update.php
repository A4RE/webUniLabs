<?php
include "base/setup.php";
session_start();
$id_vist = $_GET['id'];
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
if(isset($_POST['update_vist'])){
    $vistStartDate = $_POST['DateStart'];
    $vistEndtDate = $_POST['DateEnd'];

    $vistStartDate = strtotime($_POST['DateStart']);
    $vistEndtDate = strtotime($_POST['DateEnd']);
    $vistStartDate = date('Y-m-d', $vistStartDate);
    $vistEndDate = date('Y-m-d', $vistEndtDate);
    //обновление
    $upd = "UPDATE `Выставка` SET
                      `Дата_начала`='$vistStartDate',
                      `Дата_окончания`='$vistEndDate'
                  WHERE `id_выставки`=".$id_vist;
    $upd = mysqli_query($conn, $upd) or die ("Ошибка обновление". mysqli_error($conn));
     header("Refresh: 1; URL = admin.php");
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
<?php
$quer = mysqli_query($conn, "SELECT * FROM `Выставка` WHERE `id_выставки` =".$id_vist) or die ("Ошибка". mysqli_error($conn));
$data = mysqli_fetch_array($quer);
?>
<!--Main content-->
<div style="margin-top: 30px" class="container">
    <div class="row">
        <div class="col-md-6 m-auto border">
            <form method="post">
                <div class="mb-3">
                    <p class="text-center fw-bold fs-3 text-warning">Обновить выставку</p>
                    <p class="text-center fw-bold fs-3 ">Выставка: <?php echo $data['Название']?></p>
                    <br>
                    <label class="form-label">Дата начала события</label>
                    <input type="date" name="DateStart" class="form-control">
                    <label class="form-label">Дата окончания события</label>
                    <input type="date" name="DateEnd" class="form-control">
                </div>
                <center>
                    <input style="width: 90%" type="submit" name="update_vist" class="btn btn-lk" value="Update">
                </center>
            </form>
        </div>
    </div>
</div>

</body>
</html>

