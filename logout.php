<?php

session_start();

$is_auth = false;
$user_name = '';
$user_email = '';

$_SESSION = [];

header('Location: index.php');
