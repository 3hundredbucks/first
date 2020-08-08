<?php

require_once('functions.php');
require_once('lotsList.php');

session_start();

if(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
    $is_auth = $_SESSION['is_auth'];
    $user_email = $_SESSION['user_email'];
}

if ($is_auth) {

    $title = htmlspecialchars('Добавление лота');

    $lot_name = $_POST['lot-name'] ?? '';
    $category = $_POST['category'] ?? 'Выберите категорию';
    $message = $_POST['message'] ?? '';
    $lot_rate = $_POST['lot-rate'] ?? '';
    $lot_step = $_POST['lot-step'] ?? '';
    $file_url = $_POST['file'] ?? 'img/lot.png'; // если отсутствует загруженное изображение лота, то подставляется заглушка
    $lot_end_date = $_POST['lot-date'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $lot = [];
        $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
        $errors = [];

        foreach ($required as $key) {
            if (empty($_POST[$key])) {
                $errors[$key] = 'form__item--invalid';
                $form_error = 'form--invalid';
            }
        }

        if ($category == 'Выберите категорию') {
            $errors['category'] = 'form__item--invalid';
            $form_error = 'form--invalid';
        }

        if (!is_numeric($lot_rate)) {
            $errors[$lot_rate] = 'form__item--invalid';
            $form_error = 'form--invalid';
        }

        if (!is_numeric($lot_step)) {
            $errors[$lot_step] = 'form__item--invalid';
            $form_error = 'form--invalid';
        }

        if (!empty($_FILES['file']['name'])) {
            $file_name = $_FILES['file']['name'];
            $file_path = __DIR__ . '/img/';
            $file_url = 'img/' . $file_name;
            move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
        }

        if (count($errors)) {
            $page_content = renderTemplate('templates/add.php', [
                'form_error' => $form_error,
                'name_error' => $errors['lot-name'],
                'category_error' => $errors['category'],
                'message_error' => $errors['message'],
                'rate_error' => $errors['lot-rate'],
                'step_error' => $errors['lot-step'],
                'date_error' => $errors['lot-date'],
                'file_error' => $errors['file'],
                'lot_name' => $lot_name,
                'category' => $category,
                'message' => $message,
                'lot_rate' => $lot_rate,
                'lot_step' => $lot_step,
                'file_url' => $file_url,
                'lot_date' => $lot_end_date,
            ]);
        } else {
            $lot['pic'] = $file_url;
            $lot['item'] = $lot_name;
            $lot['price'] = $lot_rate;
            $lot['category'] = $category;

            $page_content = include_template('templates/lot.php', [
                'lot' => $lot,
                'timer' => $next_hours . ':' . $next_minutes]);
        }
    } else {
        $page_content = include_template('templates/add-lot.php');
    }

    $layout = include_template('templates/layout.php', ['is_auth' => $is_auth, 'title' => $title, 'content' => $page_content, 'user_name' => $user_name,
        'user_avatar' => $user_avatar]);

    print($layout);
}
else {
    http_response_code(403);
}
