<?php

$check =  validForLogin($_POST);

if($check == 1)
{
    $_SESSION['log_complete'] = '1';
    if(isset($_POST['remember']) && $_POST['remember'] == true) setcookie('remember', $_SESSION['remember'], time() + 36000, '/');
    unset($_SESSION['remember']);
    setcookie('id', $_SESSION['id'], time() + 3600, '/');
    header('Location: /');
    exit;
}elseif($check == 0)
{
    setcookie('check_signin', " email и/или пароль введены не верно", time() + 2, '/');
    setcookie('pass_error', "@error('name') is-invalid @enderror", time() + 2, '/');
    setcookie('email_error', "@error('name') is-invalid @enderror", time() + 2, '/');
    $_SESSION['log_complete'] = '0';
    header('Location: ./?page=login');
    exit;
}

