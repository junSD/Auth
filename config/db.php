<?php
/**
 * Инициализация подключения к базе данных
 *
 */

$dblocation = 'localhost';
$dbname = 'testauth';
$dbuser = 'root';
$dbpasswd = '';

/**
 * соединяемся с БД
 */
$db = mysqli_connect($dblocation, $dbuser, $dbpasswd, $dbname);

if (!$db) {
    echo 'Ошибка доступа к MySql';
    exit();
}
