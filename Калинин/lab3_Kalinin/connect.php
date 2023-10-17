<?php
$host = 'localhost';
$database = 'datacomp';
$username = 'root';
$password = '';
$db = mysqli_connect($host,$username,$password,$database);
if(!$db) die("Ошибка соединения с базой данных". mysqli_connect_error());