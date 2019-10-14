<?php
// Register new User
function createUser($data)
{
    $data['login'] =htmlspecialchars(trim($data['login']));
    $data['email'] =htmlspecialchars(trim($data['email']));
    $data['password'] =htmlspecialchars(trim($data['password']));
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
    $sql = 'INSERT INTO  users (login, email, password) VALUES (:login, :email, :password)';
    $stat =  $db_connect->prepare($sql);
    $stat->bindParam(':login',$data['login']);
    $stat->bindParam(':email',$data['email']);
    $stat->bindParam(':password', $data['password']);
     $res = $stat->execute();
}
// Check to email and username don't isset in database
function checkRegister($data)
{
    $data['login'] =trim($data['login']);
    $data['email'] =trim($data['email']);
    $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
    $sql = 'SELECT * FROM users WHERE login=:login OR LOWER(email) LIKE LOWER(:email)';
    $stat =  $db_connect->prepare($sql);
    $stat->bindParam(':login',$data['login']);
    $stat->bindParam(':email',$data['email']);
    $num = $stat->rowCount($stat->execute());
    $check =$stat->fetch(2);

    if($num > 0)
    {
        if($data['login'] == $check['login'])
        {
            return '1';
        }
        if(strcasecmp($data['email'],  $check['email']) == 0)
        {
            return '2';
        }
    }
    return 'ok';
}
// Check to email and password don't isset in database
function checkLogin($data)
{

    @$data['email'] = trim($data['email']);
    $data['password'] = (isset($data['current']))?trim($data['current']):trim($data['password']);


    $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
    if (isset($data['email'] ) && !empty(trim($data['email'])))
    {
        $sql = "SELECT * FROM users WHERE LOWER(email)  LIKE  LOWER(:email) ";
        $stat =  $db_connect->prepare($sql);
        $stat->bindParam(':email',$data['email']);
        $num = $stat->rowCount($stat->execute());
        $check =$stat->fetch(2);
    }else
    {
        $sql = "SELECT * FROM users WHERE user_id=:id";
        $stat =  $db_connect->prepare($sql);
        $stat->bindParam(':id',$_SESSION['id']);
        $num = $stat->rowCount($stat->execute());
        $check =$stat->fetch(2);
    }

    if($num > 0)
    {
        if(isset($_SESSION['current']) && $_SESSION['current'] == 'ok')
        {
            if(password_verify($data['password'], $check['password']))
            {
                return 1;
            }
        }
        if(strcasecmp($data['email'], $check['email']) == 0)
        {
            if(password_verify($data['password'], $check['password']))
            {
                $_SESSION['user'] = $check['login'];
                $_SESSION['id'] = $check['user_id'];
                return 1;
            }
        }


    }
    return 0;
}
//Add comment to database
function addComment ($data)
{
    $data['content'] =htmlspecialchars(trim($data['content']));
    $data['id'] =htmlspecialchars(trim($data['id']));
    $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
    $sql = 'INSERT INTO  coments (content, user_id) VALUES (:content, :user_id)';
    $stat =  $db_connect->prepare($sql);
    $stat->bindParam(':content',$data['content']);
    $stat->bindParam(':user_id',$data['id']);
    $result = $stat->execute();
    return $result;
}
// Show All comments on the main page
function showAllComents()
{
    $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
    $sql = 'SELECT * FROM coments LEFT JOIN users USING (user_id) ORDER BY id DESC';
    $stat =  $db_connect->prepare($sql);
    $stat->execute();
    $show =$stat->fetchAll(2);

    return $show;
}
// Put current username from daSELECT * FROM $table WHERE '%%'= 'PRIMARY KEY' AND WHERE '%%' =:idtabase
function getUsers()
{
    $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
    $sql = "SELECT * FROM users WHERE user_id=:id";
    $stat =  $db_connect->prepare($sql);
    $stat->bindParam(':id', $_SESSION['id']);
    $stat->execute();
    $show =$stat->fetch(2);
    return $show;
}

// Update information
function update($table, $data)
{
        $index = array_keys($data);
        if(isset($data['password'])) $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $q = '';
        $val = [];
        foreach($data as $k => $v)
        {
            $q .= $k . '=:' . $k . ',';
            $val[] = $v;

        }
        $q = rtrim($q,',');

        $db_connect = new PDO (DB['dsn'], DB['username'], DB['password']);
        $sql = "UPDATE $table SET $q WHERE user_id=:id";
        $stat = $db_connect->prepare($sql);
        for($i = 0; $i < count($index); $i++)
        {
            $stat->bindParam($index[$i],$val[$i]);
        }
        $stat->bindParam(':id',$_SESSION['id']);
        $res = $stat->execute();
        return $res;


}