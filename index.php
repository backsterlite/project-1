<?php
    session_start();
    error_reporting(-1);


    setcookie('save_email', 'true', time() + 3600, '/');
    setcookie('save_login', 'true', time() + 3600, '/');


    require_once 'variables.php';
    require_once 'QueryBilder.php';

 $posts = showAllComents();



    include './' . $_GET['page'] . '.php';