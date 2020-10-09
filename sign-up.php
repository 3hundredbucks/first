<?php
require('init.php');
require('functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requiered_fields = ['email', 'password', 'name', 'message'];
    $errors = [];
    $text_error = [];

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';
    $file_url = 'img/' . $_POST['file'] ?? 'img/user.jpg'; //заглушку нужно будет подставить

//Проверка файлов на пустоту
    foreach ($requiered_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'form__item--invalid';
            $form_error = 'form--invalid';
            $text_error[$field] = 'Заполните поле!';
        } elseif ($field == 'email') {
            if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
                $errors = 'form__item--invalid';
                $text_error = 'Введите корректную почту';
                $form_error = 'form--invalid';
            }
        }
    }

//Проверка существования почты в базе данных
    if (empty($errors)) {
        if (!$link) {
            print('Нет доступа к базе данных');
        }
        $query_result = mysqli_query($link, 'SELECT id_users FROM users WHERE email = \'' . $email . '\'');
        $user = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
        if (!empty($user)) {
            $errors['email'] = 'form__item--invalid';
            $text_error['email'] = 'Пользователь с такой почтой зарегестрирован';
            $form_error = 'form--invalid';
        }
    }

    if (!empty($_FILES['file']['name'])) {
        $file_name = $_FILES['file']['name'];
        $file_path = __DIR__ . '/img/';
        $file_url = 'img/' . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
    }
    if (!empty($errors)) {
        $page_content = include_template('templates/sign-up.php', [
            'form_error' => $form_error,
            'email_error' => $errors['email'],
            'description_email_err' => $text_error['email'],
            'pass_error' => $errors['password'],
            'description_pass_err' => $text_error['password'],
            'name_error' => $errors['name'],
            'contact_error' => $errors['message'],
            'email' => $email,
            'name' => $name,
            'message' => $message,
        ]);
        $layout_content = include_template('templates/layout.php', [
            'page_content' => $page_content,
            'content' => $page_content,
            'title' => 'Регистрация',
            'main_class' => '']);
    }

    if(empty($errors)){
        if(!$link){
            print('Ошибка подключения к БД');
        }
        else
            $stmt = mysqli_prepare($link, "INSERT INTO users (dat_add, email, name, password, avatar_path) VALUES (?,?,?,?,?)");
            mysqli_stmt_bind_param($stmt,'sssss',date('Y-m-d H:i:s'),$email, $name, password_hash($password, PASSWORD_DEFAULT), $file_url);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($link);

        }
}
else{
    $page_content = include_template('templates/sign-up.php', []);
    $layout_content = include_template('templates/layout.php', [
        'page_content' => $page_content,
        'content' => $page_content,
        'title' => 'Регистрация',
        'main_class' => ''] );
}

print($layout_content);
