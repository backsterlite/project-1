<?php
if($_SESSION['log_complete'] == '1')
{
    $_POST['nickname'] = $_SESSION['user'];
    $_POST['id'] = $_SESSION['id'];
}
if(isset($_POST) && empty(trim($_POST['content'])))
{
    setcookie('empty_content', "@error('name') is-invalid @enderror", time() + 1, '/');
    header('Location: /');
    exit;
}else
{
    require_once 'QueryBilder.php';
    $result = addComment($_POST);
    if($result === true)
    {
        setcookie('send', "1", time() + 1, '/');
    }else{
        setcookie('send', '2', time() + 1, '/');
    }
    header('Location: /');
    exit;
}

