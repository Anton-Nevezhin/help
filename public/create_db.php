<?php

$host = '127.0.0.1';
$user = 'root';
$password = 'root';

$connection = mysqli_connect($host, $user, $password);

if (!$connection) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS help_db";
if (mysqli_query($connection, $sql)) {
    echo "База данных help_db успешно создана";
} else {
    echo "Ошибка: " . mysqli_error($connection);
}

mysqli_close($connection);