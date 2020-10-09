<?php
$link = mysqli_connect('localhost', 'root', '7C8v10D5h6h6', 'yeticave');

if(!$link){
    $error = mysqli_connect_error();
    include_template('error.php', ['header' => 'Ошибки соединения с БД','error' => $error]);
}

mysqli_set_charset($link, 'utf8');

