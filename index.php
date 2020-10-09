<?php
require_once('lotsList.php');
require_once('functions.php');

session_start();

if(!$link){
    print("Нет доступа к базе данных");
}
else{
    $query_cat = mysqli_query($link, 'SELECT id_cat, cat_name FROM category ORDER BY id_cat');
    if($query_cat) {
        $categories = mysql_fetch_all($query_cat, MYSQLI_ASSOC);
    }
    else{
        print("Ошибка: " . mysqli_error($link));
    }
}

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
