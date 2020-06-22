<?php

$title = htmlspecialchars('Главная');
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

date_default_timezone_set("Europe/Moscow");
$time = date('H.i');
$time = date('d.m.Y'); //метка на текущее время
$next_day = strtotime($time) + 86400;
$time = date('U');
$next_hours = floor(($next_day - $time) / 3600);
$next_minutes = floor( ( ($next_day - $time) % 3600) / 60 );

if($next_hours < 10){
    $next_hours = '0'.$next_hours;
}
if($next_minutes < 10){
    $next_minutes = '0'.$next_minutes;
}

$lotsList = [['item' => '2014 Rossignol District Snowboard',
    'category' => 'Доски и лыжи', 'price' => 10999, 'pic' => 'img/lot-1.jpg', 'alt' => 'Сноуборд'],
    ['item' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи', 'price' => 159999, 'pic' => 'img/lot-2.jpg', 'alt' => 'Сноуборд'],
    ['item' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления', 'price' => 8000, 'pic' => 'img/lot-3.jpg', 'alt' => 'Крепления'],
    ['item' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки', 'price' => 10999, 'pic' => 'img/lot-4.jpg', 'alt' => 'Ботинки'],
    ['item' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда', 'price' => 7500, 'pic' => 'img/lot-5.jpg', 'alt' => 'Куртка'],
    ['item' => 'Маска Oakley Canopy',
        'category' => 'Разное', 'price' => 5400, 'pic' => 'img/lot-6.jpg', 'alt' => 'Маска']
]
?>
