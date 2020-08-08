<?php
require_once('lotsList.php');
require_once('functions.php');

session_start();

if(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
    $is_auth = $_SESSION['is_auth'];
    $user_email = $_SESSION['user_email'];
}

$title = htmlspecialchars('Главная');


$page_content = include_template('templates/index.php', ['title' => $title, 'user_name' => $user_name, 'user_avatar' => $user_avatar,
    'lotsList' => $lotsList, 'timer' => $next_hours.':'.$next_minutes]);
$layout = include_template('templates/layout.php', ['is_auth' => $is_auth, 'title' => $title, 'content' => $page_content, 'user_name' => $user_name,
                                                    'user_avatar' => $user_avatar]);

print($layout);
