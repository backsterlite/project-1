<?php
    session_start();
    error_reporting(-1);


    setcookie('save_email', 'true', time() + 3600, '/');
    setcookie('save_login', 'true', time() + 3600, '/');


    require_once 'variables.php';
    require_once 'QueryBilder.php';
    require_once 'Validation.php';
    require_once 'Config.php';
if(isset($_COOKIE['remember']) && $_COOKIE['remember'] == '1')
{
    $_SESSION['log_complete'] = '1';
    $user = getUserName($_COOKIE['id']);
    $_SESSION['user'] = $user['login'];
}

 $posts = showAllComents();



    include './' . $_GET['page'] . '.php';
