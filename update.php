<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request = [];
        if(isset($_POST['security']) && $_POST['security'] == '1')
        {
            if(isset($_POST['current']) && !empty(trim($_POST['current'])) )
            {
                $_SESSION['current'] = 'ok';
                $ans = checkLogin($_POST);
                unset($_SESSION['current']);
                if($ans == 1)
                {
                    if(isset($_POST['password']) && !empty(trim($_POST['password']))
                        && isset($_POST['password_confirmation']) && !empty(trim($_POST['password_confirmation'])))
                    {
                        if($_POST['password'] == $_POST['password_confirmation'])
                        {
                            $data['password'] = $_POST['password'];
                            update('users',$data);
                            setcookie('pass_change', '1', time() + 2, '/');
                            header('Location: ./?page=profile');
                            exit;
                        }else{
                            setcookie('pass_change', '0', time() + 2, '/');
                            setcookie('confirm_pass_error', 'Пароли не совпадают', time() + 2, '/');
                            setcookie('confirm_error_msg', '@error(\'name\') is-invalid @enderror', time() + 2, '/');
                            header('Location: ./?page=profile');
                            exit;
                        }
                    }else{
                        setcookie('pass_change', '0', time() + 2, '/');
                        setcookie('confirm_pass_error', 'Заполните ето поле', time() + 2, '/');
                        setcookie('confirm_error_msg', '@error(\'name\') is-invalid @enderror', time() + 2, '/');
                        header('Location: ./?page=profile');
                        exit;
                    }

                }else{
                    setcookie('pass_change', '0', time() + 2, '/');
                    setcookie('current_pass_error', 'Пароль введен не верно', time() + 2, '/');
                    setcookie('current_error', '@error(\'name\') is-invalid @enderror', time() + 2, '/');

                    header('Location: ./?page=profile');
                    exit;
                }
            }else{
                setcookie('pass_change', '0', time() + 2, '/');
                setcookie('current_pass_empty', 'Заполните ето поле', time() + 2, '/');
                setcookie('current_error_empty', '@error(\'name\') is-invalid @enderror', time() + 2, '/');

                header('Location: ./?page=profile');
                exit;
            }
        }
        if ((isset($_POST) && !empty($_POST))) {
            foreach ($_POST as $k => $v)
            {
                if (isset($_POST[$k])) {
                    if (!empty(trim($_POST[$k]))) {
                        $request[$k] = trim($_POST[$k]);
                    }
                }

            }
        }

if (isset($_FILES) && $_FILES['image']['error'] == 0)
        {
            $format = strrchr($_FILES['image']['name'], '.');
            $avatarName = uniqid();
            move_uploaded_file($_FILES['image']['tmp_name'], AVATARS_PATH . $avatarName . $format);
            $request['avatar_path'] = AVATARS_PATH . $avatarName . $format;

            require_once 'QueryBilder.php';
            $d_path = getUsers();
            if ($d_path['avatar_path'] == '')
            {
                $res = update('users', $request);
                if ($res === true) {
                    setcookie('reg_complete', '1', time() + 2, '/');
                    header('Location: ./?page=profile');
                    exit;
                } else {
                    setcookie('reg_complete', '0', time() + 2, '/');
                    header('Location: ./?page=profile');
                    exit;
                }
            }else
             {
                 if(file_exists($d_path['avatar_path']))
                 {
                     $del = unlink($d_path['avatar_path']);
                     if ($del === true)
                     {
                         $res = update('users', $request);
                         if ($res === true) {
                             setcookie('reg_complete', '1', time() + 2, '/');
                             header('Location: ./?page=profile');
                             exit;
                         } else {
                             setcookie('reg_complete', '0', time() + 2, '/');
                             header('Location: ./?page=profile');
                             exit;
                         }
                     }else {
                         unset($request['avatar_path']);
                         $res = update('users', $request);
                         if ($res === true) {
                             setcookie('reg_complete', '1', time() + 2, '/');
                             header('Location: ./?page=profile');
                             exit;
                         } else {
                             setcookie('reg_complete', '0', time() + 2, '/');
                             header('Location: ./?page=profile');
                             exit;
                         }
                     }
                 }else{
                     $res = update('users', $request);
                     if ($res === true) {
                         setcookie('reg_complete', '1', time() + 2, '/');
                         header('Location: ./?page=profile');
                         exit;
                     } else {
                         setcookie('reg_complete', '0', time() + 2, '/');
                         header('Location: ./?page=profile');
                         exit;
                     }
                 }

             }
        }
        $res = update('users', $request);
        if ($res === true) {
            setcookie('reg_complete', '1', time() + 2, '/');
            header('Location: ./?page=profile');
            exit;
        } else {
            setcookie('reg_complete', '0', time() + 2, '/');
            header('Location: ./?page=profile');
            exit;
        }
    }





