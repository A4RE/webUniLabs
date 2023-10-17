<?php
$host = 'localhost';
$db_name = 'stroitel';
$db_user = 'root';
$db_pass = '';

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
if(!$conn){
    die("Ошибка соединения с базой данных". mysqli_connect_error());
}

