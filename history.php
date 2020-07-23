<?php

require_once ('functions.php');
require_once ('lotsList.php');

$lots_viewed = intval(json_decode($_COOKIE['lotsviewed' . $user_name]));

$page_content = include_template('templates/lot.php', ['lotsList' => $lotsList, 'lots_viewed'=> $lots_viewed, 'timer' => $next_hours.':'.$next_minutes]);
$layout = include_template('templates/layout.php', ['title' => $title, 'content' => $page_content, 'user_name' => $user_name,
    'user_avatar' => $user_avatar]);

print($layout);
