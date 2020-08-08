<?php
require_once ('functions.php');
require_once ('userdata.php');
require_once ('lotsList.php');

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $requested_fields = ['email', 'password'];
    $errors = [];
    $text_error = [];

    $email = $_POST['email']  ?? '';
    $password = $_POST['password'] ?? '';

    foreach ($requested_fields as $field){
        if(empty($_POST[$field])){
            $errors[$field] = 'form__item--invalid';
            $text_error[$field] = 'Поле должно быть заполнено!';
            $form_error = 'form--invalid';
        }
        elseif ($field == 'email') {
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[$field] = 'form__item--invalid';
                $text_error[$field] = 'Введите корректный email!';
                $form_error = 'form--invalid';
            }

        }
    }

    if(empty($errors)){
        foreach ($users as $user){
            if ($user['email'] == $email){
                if(password_verify($password, $user['password'])){
                    $errors = [];
                    $text_error = [];
                    $is_auth = true;
                    $user_name = $user['name'];
                    $user_email = $user['email'];
                    setcookie('user_email', $user['email'], strtotime('+1 year'), '/');
                    break;
                }
                else{
                    $errors['password'] = 'form__item--invalid';
                    $text_error['password'] = 'Введите верный пароль!';
                }
            }
            else{
                $errors['password'] = 'form__item--invalid';
                $text_error['password'] = 'Введите верный логин!';
            }
        }
    }

    if(empty($errors)){
        $_SESSION['user_name'] = $user_name;
        $_SESSION['is_auth'] = true;
        $_SESSION['user_email'] = $user_email;

        header('Location: index.php');
    }

    if (!empty($errors)) {
        $page_content = include_template('templates/login.php', [
            'form_error' => $form_error,
            'email_error' => $errors['email'],
            'description_email_err' => $text_error['email'],
            'pass_error' => $errors['password'],
            'description_pass_err' => $text_error['password'],
            'email' => $email,
        ]);

        $layout_content = include_template('templates/layout.php', [
            'content' => $page_content,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar,
            'title' => 'Вход',
        ]);
    }
}
else{
    if(isset($_SESSION['user_name'])){
        $user_name = $_SESSION['user_name'];
        $user_email = $_SESSION['user_email'];
    }
    elseif(isset($_COOKIE['user_email'])){
        $email = $_COOKIE['user_email'];
    }
    else{
        $email = '';
    }

    $page_content = include_template('templates/login.php', ['email' => $email]);
    $layout_content = include_template('templates/layout.php', [
        'page_content' => $page_content,
        'content' => $page_content,
        'title' => 'Вход',
        'main_class' => ''] );
}

print($layout_content);

