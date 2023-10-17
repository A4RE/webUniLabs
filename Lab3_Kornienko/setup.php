<?php
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'auto';

$dp = mysqli_connect($db_host, $db_user, $db_password, $db_db);

if(!$dp) die("Ошибка соединения с MySQL-сервером". mysqli_connect_error());
?>
