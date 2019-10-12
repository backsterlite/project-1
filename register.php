<?php
if($_SESSION['check'] == 1)
{
    setcookie('login_error', "@error('name') is-invalid @enderror", time() - 3600, '/');
    setcookie('email_error', "@error('name') is-invalid @enderror", time() - 3600, '/');
    setcookie('pass_error', "@error('name') is-invalid @enderror", time() - 3600, '/');
    setcookie('passlen_error', "@error('name') is-invalid @enderror", time() - 3600, '/');
    setcookie('All_error', "@error('name') is-invalid @enderror", time() - 3600, '/');
    setcookie('check_login', "Такое имя уже занято", time() - 3600, '/');
    setcookie('check_email', "Такой email уже существует", time() - 3600, '/');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="./">
                    Project
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <?php if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '1'): ?>
                        <ul class="navbar-nav ml-auto">
                            <li>Здравствуй <?= $_SESSION['user']?></li>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="/?page=logout&log=exit">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/?page=profile">Profile</a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="navbar-nav ml-auto">
                            <li>Здравствуй Гость</li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="/?page=login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/?page=register">Register</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <!-- Right Side Of Navbar -->

                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>

                            <div class="card-body">
                                <div style="color:red;"><?php if(isset($_COOKIE['check_login'])){echo $_COOKIE['check_login'];}
                                            elseif(isset($_COOKIE['check_email'])){echo $_COOKIE['check_email'];}  ?></div>
                                <form method="POST" action="./?page=signup">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name(Maximum 50 character)</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control <?php $err = (isset($_COOKIE['login_error']))?  $_COOKIE['login_error']:  @$_COOKIE['All_error']; echo @$err;?>" name="login" autofocus>

                                                <span class="invalid-feedback " role="alert">
                                                     <?php if(isset($_COOKIE['login_error'])): ?>
                                                         <strong>НЕДОПУСТИМАЯ ДЛИНА</strong>
                                                     <?php else: ?>
                                                         <strong>МЫ ХАКЕРОВ НЕ ЛЮБИМ</strong>
                                                     <?php endif; ?>
                                            </span>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" name="email" type="email" class="form-control <?php $err = (isset($_COOKIE['email_error']))?  $_COOKIE['email_error']:  @$_COOKIE['All_error']; echo @$err;?>"  >
                                                <span class="invalid-feedback" role="alert">
                                                     <?php if(isset($_COOKIE['email_error'])): ?>
                                                        <strong>НЕКОРЕКТНЫЙ EMAIL</strong>
                                                    <?php else: ?>
                                                        <strong>МЫ ХАКЕРОВ НЕ ЛЮБИМ</strong>
                                                    <?php endif; ?>
                                            </span>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control <?php if(isset($_COOKIE['passlen'])){echo $_COOKIE['passlen'];}
                                                                                                    if(isset($_COOKIE['pass_error'])){echo $_COOKIE['pass_error'];}
                                                                                                    if(isset($_COOKIE['All_error'])){echo $_COOKIE['All_error'];}?> " name="password"  autocomplete="new-password">
                                            <span class="invalid-feedback" role="alert">
                                                <?php if(isset($_COOKIE['passlen'])): ?>
                                                <strong>Длина пароля не меньше 6 знаков</strong>
                                                <?php elseif(isset($_COOKIE['pass_error'])): ?>
                                                <strong>ПАРОЛИ НЕ СОВПАДАЮТ</strong>
                                                <?php else: ?>
                                                <strong>МЫ ХАКЕРОВ НЕ ЛЮБИМ</strong>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control <?php $err = (isset($_COOKIE['pass_error']))?  $_COOKIE['pass_error']:  @$_COOKIE['All_error']; echo @$err;?>" name="password_confirmation"  autocomplete="new-password">
                                                <span class="invalid-feedback" role="alert">
                                                    <?php if(isset($_COOKIE['pass_error'])): ?>
                                                        <strong>ПАРОЛИ НЕ СОВПАДАЮТ</strong>
                                                    <?php else: ?>
                                                        <strong>МЫ ХАКЕРОВ НЕ ЛЮБИМ</strong>
                                                    <?php endif; ?>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php debug($_COOKIE);  debug($_SESSION); ?>
</body>
</html>


