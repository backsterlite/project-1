<?php
if($_SESSION['log_complete'] == '1')
{
    $_POST['nickname'] = $_SESSION['user'];
}
if(isset($_POST) && empty($_POST['content']) && empty($_POST['nickname']))
{
    setcookie('empty_nickname', "@error('name') is-invalid @enderror", time() + 1, '/');
    setcookie('empty_content', "@error('name') is-invalid @enderror", time() + 1, '/');
    header('Location: /');
    exit;
}elseif(isset($_POST) && empty($_POST['content']))
{
    setcookie('empty_content', "@error('name') is-invalid @enderror", time() + 1, '/');
    header('Location: /');
    exit;
}elseif(isset($_POST) && empty($_POST['nickname']))
{
    setcookie('empty_nickname', "@error('name') is-invalid @enderror", time() + 1, '/');
    header('Location: /');
    exit;
}else
{
    require_once 'QueryBilder.php';

    $result = addComment($_POST);
    if($result === true)
    {
        setcookie('send', "1", time() + 1, '/');
        $_SESSION['num'] = 31;
    }else{
        setcookie('send', '2', time() + 0, '/');
    }
    header('Location: /');

    exit;
}

