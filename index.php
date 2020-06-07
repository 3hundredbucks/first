<?php
require_once('functions.php');
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

$page_content = include_template('templates/index.php', ['timer' => $next_hours.':'.$next_minutes]);
$layout = include_template('templates/layout.php', ['title' => $title, 'content' => $page_content, 'user_name' => $user_name,
                                                    'user_avatar' => $user_avatar]);

print($layout);
?>
