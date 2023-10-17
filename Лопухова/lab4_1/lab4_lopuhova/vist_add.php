<?php
if(isset($_POST['add_vistavka'])){
    include "base/setup.php";
    $vistName = $_POST['VName'];
    $vistStartDate = $_POST['DateStart'];
    $vistEndtDate = $_POST['DateEnd'];
    $vistAdres = $_POST['VAdres'];
    $vistOrg = $_POST['VOrgList'];

    $vistStartDate = strtotime($_POST['DateStart']);
    $vistEndtDate = strtotime($_POST['DateEnd']);
    $vistStartDate = date('Y-m-d', $vistStartDate);
    $vistEndtDate = date('Y-m-d', $vistEndtDate);
    //Добавление выставки в БД
    $addVist = "INSERT INTO `Выставка`(`Название`, `Дата_начала`, `Дата_окончания`, `Адрес`, `id_организатора`)
                VALUES ('$vistName', '$vistStartDate', '$vistEndtDate', '$vistAdres', $vistOrg)";
    $addVist = mysqli_query($conn, $addVist) or die ("Ошибка добавление". mysqli_error($conn));
    header("location: index.php");
}
?>
<table class="table table-hover">
    <thead>
    <th></th>
    </thead>
</table>
