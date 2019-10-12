<?php
if($_GET['log'] == 'exit' )
{
    $_SESSION['log_complete'] = '0';
    if(isset($_COOKIE['id'], $_COOKIE['remember']))
    {
        setcookie('id', $_SESSION['id'], time() - 360, '/');
        setcookie('remember', '1', time() - 360, '/' );
    }

    header('Location: /');
}