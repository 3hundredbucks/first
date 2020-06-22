<?php

require_once('functions.php');
require_once('lotsList.php');

$lot = null;

if (isset($_GET['id'])){
    $lot_id = $_GET['id'];
    $lot = $lotsList[$lot_id];
}
if (!$lot) {
    http_response_code(404);
}

$page_content = include_template('templates/lot.php', ['lot' => $lot, 'timer' => $next_hours.':'.$next_minutes]);
$layout = include_template('templates/layout.php', ['title' => $title, 'content' => $page_content, 'user_name' => $user_name,
    'user_avatar' => $user_avatar]);

print($layout);

