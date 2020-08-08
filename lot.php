<?php
require_once('functions.php');
require_once('lotsList.php');

session_start();

if(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
    $is_auth = $_SESSION['is_auth'];
    $user_email = $_SESSION['user_email'];
}

$title = htmlspecialchars('Лот');

$lot = null;

if (isset($_GET['id'])){
    $lot_id = $_GET['id'];
    $lot = $lotsList[$lot_id];
    if(!empty($lotsList)){
        if(!empty($lost_viewed)){
            foreach ($lots_viewed as $viewed){
                if($lot_id == $viewed){
                    $new_item = false;
                    break;
                }
                else{
                    $new_item = true;
                }
            }
        }
        else{
            $new_item = true;
        }
    }
    if($new_item){
        $lots_viewed = $lot_id;
        setcookie('lotsviewed' . $user_name, json_encode($lots_viewed), strptime('+ 1 week'), '/');
    }

}
if (!$lot) {
    http_response_code(404);
}



$page_content = include_template('templates/lot.php', ['lot' => $lot, 'timer' => $next_hours.':'.$next_minutes]);
$layout = include_template('templates/layout.php', ['is_auth' => $is_auth, 'title' => $title, 'content' => $page_content, 'user_name' => $user_name,
    'user_avatar' => $user_avatar]);

print($layout);

