<?php
function validForRegister($data)
{
    if(isset($_POST) && !empty($_POST))// Check if the form  been submitted
    {
        if(isset($_POST['login'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']) )//Check to all field been send
        {
            if($_POST['login'] != '' && strlen($_POST['login']) <= 50)// Check to the field wasn't empty and it length not more than 50
            {
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))// Check to EMAIL print correct
                {
                    if($_POST['password'] == $_POST['password_confirmation'])// Check to password equal confirm-password
                    {
                        if(strlen($_POST['password']) >= 6)
                        {
                            $check = true;
                        }else{
                            setcookie('passlen', "@error('name') is-invalid @enderror", time() + 2, '/');
                            header('Location: ./?page=register');
                            exit;
                        }

                    }else{
                        setcookie('pass_error', "@error('name') is-invalid @enderror", time() + 2, '/');
                        header('Location: ./?page=register');
                        exit;
                    }
                }else
                {
                    $_SESSION['check'] = 1;
                    setcookie('email_error', "@error('name') is-invalid @enderror", time() + 2, '/');
                    $_COOKIE['save_login'] = htmlspecialchars($_POST['login']);
                    header('Location: ./?page=register');
                    exit;
                }
            }else
            {
                $_SESSION['check'] = 1;
                setcookie('login_error', "@error('name') is-invalid @enderror", time() + 2, '/');
                $_COOKIE['save_email'] = htmlspecialchars($_POST['email']);
                header('Location: ./?page=register');
                exit;
            }
        }else
        {
            setcookie('All_error', "@error('name') is-invalid @enderror", time() + 2, '/');
            header('Location: ./?page=register');
            exit;
        }
    } else{
        header('Location:./?page=register');

    }
}

function validForLogin($data)
{
    if(isset($_POST) && !empty($_POST))// Check if the form  been submitted
    {
        if(isset($_POST['email'],  $_POST['password']) )//Check to all field been send
        {
            if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
            {
                if(isset($_POST['remember']) && $_POST['remember'] == true)
                {
                    setcookie('remember', '1', time() + 36000, '/');
                }

                require_once 'QueryBilder.php';
                $res = checkLogin($_POST);
            }else
            {
                setcookie('check_signin', " Заполните пустые поля", time() + 2, '/');
                setcookie('pass_error', "@error('name') is-invalid @enderror", time() + 2, '/');
                setcookie('email_error', "@error('name') is-invalid @enderror", time() + 2, '/');
                header('Location: ./?page=login');
                exit;
            }

        }else
        {
            setcookie('check_signin', " Заполните пустые поля", time() + 2, '/');
            setcookie('pass_error', "@error('name') is-invalid @enderror", time() + 2, '/');
            setcookie('email_error', "@error('name') is-invalid @enderror", time() + 2, '/');
            header('Location: ./?page=login');
            exit;
        }
    } else{
        header('Location:./?page=login');
    }
    return $res;
}