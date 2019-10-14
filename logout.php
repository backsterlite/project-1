<?php
if($_GET['log'] == 'exit' )
{
    $_SESSION['log_complete'] = '0';
    if(isset($_COOKIE['id'] ))
    {
        setcookie('id', $_SESSION['id'], time() - 360, '/');
    }
    if(isset($_COOKIE['remember']))
    {
        setcookie('remember', '1', time() - 360, '/' );
    }
    session_unset();
    session_destroy();

    header('Location: /');
    exit;
}