<?php
    session_start();
    error_reporting(-1);
    require_once 'variables.php';
    require_once 'QueryBilder.php';
    require_once 'Validation.php';
    require_once 'Config.php';
if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '1')
{
    $user = getUsers();
    $_SESSION['user'] = $user['login'];
    $_SESSION['avatar_path'] = $user['avatar_path'];
    $_SESSION['user_email'] = $user['email'];
}
if(isset($_COOKIE['remember']) && $_COOKIE['remember'] == '1')
{
    if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '0')
    {
        $_SESSION['log_complete'] = '1';
        $user = getUsers();
        $_SESSION['user'] = $user['login'];
        $_SESSION['avatar_path'] = $user['avatar_path'];
        $_SESSION['user_email'] = $user['email'];
    }

}

if($_GET['page'] == 'main') $posts = showAllComents();



    include './' . $_GET['page'] . '.php';
