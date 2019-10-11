<?php


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
