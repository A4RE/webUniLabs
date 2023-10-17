<?php
include "base/setup.php";
$id_vist = $_GET['id'];
mysqli_query($conn, "DELETE FROM `Выставка` WHERE `id_выставки` =".$id_vist) or die ("Ошибка добавление". mysqli_error($conn));
header("Refresh: 0.1; admin.php");
