<?php
include "vendor/connect.php";
session_start();
$id_sotr = $_GET['id'];
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
if(isset($_POST['update'])){
    $id_dolz = $_POST['dolzList'];
    $oklad_sotr = $_POST['oklad'];

    //обновление
    $upd = "UPDATE `Сотрудник` SET 
                       `ID_должн`= $id_dolz,
                       `Оклад`= $oklad_sotr
                   WHERE `ID_сотр`=".$id_sotr;
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

    <link href="assets/style/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<?php
include "header.php";
?>
<?php
$quer = mysqli_query($conn, "SELECT * FROM `Сотрудник` WHERE `ID_сотр` =".$id_sotr) or die ("Ошибка". mysqli_error($conn));
$data = mysqli_fetch_array($quer);
?>
<!--Main content-->
<div style="margin-top: 30px" class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <form method="post">
                <div class="mb-3">
                    <p class="text-center fw-bold fs-3"><?php echo $data['ФИО']?></p>
                    <br>
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
                    <input type="number" name="oklad" class="form-control" value="<?php echo $data['Оклад']?>"
                </div>
                <center>
                    <input style="width: 90%" type="submit" name="update" class="btn btn-lk" value="Обновить">
                </center>
            </form>
        </div>
    </div>
</div>

</body>
</html>

