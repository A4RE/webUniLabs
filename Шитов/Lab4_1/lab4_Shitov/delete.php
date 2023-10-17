<?php
include "vendor/connect.php";
$id_acia = $_GET['id'];
mysqli_query($conn, "DELETE FROM `Событие` WHERE `id_события` =".$id_acia) or die ("Ошибка удаления". mysqli_error($conn));
header("Refresh: 0.1; admin.php");
