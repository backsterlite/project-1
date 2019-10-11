<?php

function createUser($data)
{
    $data['login'] =htmlspecialchars(trim($data['login']));
    $data['email'] =htmlspecialchars(trim($data['email']));
    $data['email'] =htmlspecialchars(trim($data['password']));
    $db_connect = new PDO ('mysql:dbname=markup; host=localhost', 'root', '');
    $sql = 'INSERT INTO  users (login, email, password) VALUES (:login, :email, :password)';
    $stat =  $db_connect->prepare($sql);
    $stat->bindParam(':login',$data['login']);
    $stat->bindParam(':email',$data['email']);
    $stat->bindParam(':password', $data['password']);
    $stat->execute();
}

function checkRegister($data)
{
    $data['login'] =htmlspecialchars(trim($data['login']));
    $data['email'] =htmlspecialchars(trim($data['email']));
    $db_connect = new PDO ('mysql:dbname=markup; host=localhost', 'root', '');
    $sql = 'SELECT * FROM users WHERE login=:login OR email=:email';
    $stat =  $db_connect->prepare($sql);
    $stat->bindParam(':login',$data['login']);
    $stat->bindParam(':email',$data['email']);
    $num = $stat->rowCount($stat->execute());
    $check =$stat->fetch(2);

    if($num > 0)
    {
        if($_POST['login'] == $check['login'])
        {
            return 1;
        }
        if($_POST['email'] == $check['email'])
        {
            return 2;
        }
    }
    $_SESSION['check'] = 1;
    return 0;
}