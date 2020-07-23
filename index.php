<?php
require_once('lotsList.php');
require_once('functions.php');

$title = htmlspecialchars('Главная');


$page_content = include_template('templates/index.php', ['title' => $title, 'user_name' => $user_name, 'user_avatar' => $user_avatar,
    'lotsList' => $lotsList, 'timer' => $next_hours.':'.$next_minutes]);
$layout = include_template('templates/layout.php', ['title' => $title, 'content' => $page_content, 'user_name' => $user_name,
                                                    'user_avatar' => $user_avatar]);

print($layout);
