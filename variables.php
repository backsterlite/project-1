<?php

function debug ($arg)
{
    echo '<pre>';
    var_dump($arg);
    echo '</pre>';
}

if(!isset($_GET['page']))
{
    $_GET['page'] = 'main';
}