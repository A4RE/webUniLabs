<?php
include "vendor/connect.php";
$id_sotr = $_GET['id'];
mysqli_query($conn, "DELETE FROM `Сотрудник` WHERE `ID_Сотрудника` =".$id_sotr) or die ("Ошибка удаления". mysqli_error($conn));
header("Refresh: 0.1; admin.php");
