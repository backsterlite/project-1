<?php
//Validation and create  new user
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
if($check === true)
{
    require_once 'QueryBilder.php';
    if(checkRegister($_POST) == 1)
    {
        setcookie('check_login', "Такое имя уже занято", time() + 2, '/');
        header('Location: ./?page=register');
    }elseif(checkRegister($_POST) == 2){
        setcookie('check_email', "Такой email уже существует", time() + 2, '/');
        header('Location: ./?page=register');
    }elseif(checkRegister($_POST) == 0)
    {
        createUser($_POST);
        setcookie('reg_complete', "1", time() + 2, '/');
        header('Location: ./?page=login');
    }

}