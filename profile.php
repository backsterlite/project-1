<?php if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '0')
{
    header('Location: /');
    exit;
}?>
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
                <a class="navbar-brand" href="/">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Профиль пользователя</h3></div>

                        <div class="card-body">
                            <?php if(isset($_COOKIE['reg_complete']) && $_COOKIE['reg_complete'] == '1'): ?>
                          <div class="alert alert-success" role="alert">
                            Профиль успешно обновлен
                          </div>
                            <?php elseif(isset($_COOKIE['reg_complete']) && $_COOKIE['reg_complete'] == '0'): ?>
                                <div class="alert alert-danger" role="alert">
                                   Произошла ошибка!
                                </div>
                            <?php endif; ?>

                            <form action="./?page=update" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput5">Name</label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="login" id="exampleFormControlInput5" placeholder="<?= @$_SESSION['user'] ?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput6">Email</label>

                                            <div class="col-md-6">
                                                <input type="email" class="form-control " name="email" id="exampleFormControlInput6" placeholder="<?= @$_SESSION['user_email'] ?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput7">Аватар</label>
                                            <div class="col-md-6">
                                                <input type="file" class="form-control <?=  @$_COOKIE['file_error'];?>" name="image" id="exampleFormControlInput7">
                                                <?php if(isset($_COOKIE['check_delete'])): ?>
                                                <span class="invalid-feedback " role="alert">

                                                         <strong><?php echo $_COOKIE['check_delete']; ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="<?php $src = (isset($_SESSION['avatar_path']))? strstr(str_replace('\\', '/',$_SESSION['avatar_path']), '/profile'): 'img/no-user.jpg'; echo   $src ?>" alt="" class="img-fluid">
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-warning">Edit profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Безопасность</h3></div>

                        <div class="card-body">
                            <?php if(isset($_COOKIE['pass_change']) && $_COOKIE['pass_change'] == '1'): ?>
                                <div class="alert alert-success" role="alert">
                                    Профиль успешно обновлен
                                </div>
                            <?php elseif(isset($_COOKIE['pass_change']) && $_COOKIE['pass_change'] == '0'): ?>
                                <div class="alert alert-danger" role="alert">
                                    Произошла ошибка!
                                </div>
                            <?php endif; ?>

                            <form action="/?page=update" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Current password</label>
                                            <div class="col-md-6">

                                                <input type="password" name="current" class="form-control <?php if(isset($_COOKIE['current_error_empty']))   echo $_COOKIE['current_error_empty'];  if(isset($_COOKIE['current_error']))   echo $_COOKIE['current_error'];?>" id="exampleFormControlInput1">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php if(isset($_COOKIE['current_pass_empty']))   echo $_COOKIE['current_pass_empty'];  if(isset($_COOKIE['current_pass_error']))   echo $_COOKIE['current_pass_error'];?></strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">New password</label>
                                            <div class="col-md-6">
                                                <input type="password" name="password" class="form-control  <?= @$_COOKIE['confirm_error_msg'];?>" id="exampleFormControlInput2">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= @$_COOKIE['confirm_pass_error']?></strong>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput3">Password confirmation</label>
                                            <div class="col-md-6">
                                                <input type="password" name="password_confirmation" class="form-control <?= @$_COOKIE['confirm_error_msg'];?>" id="exampleFormControlInput3">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= @$_COOKIE['confirm_pass_error']?></strong>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="security" class="form-control <?= @$_COOKIE['pass_error'];?>"  value="1">
                                        </div>

                                        <button class="btn btn-success">Submit</button>
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
<?php var_dump($_COOKIE);
var_dump($_SESSION); ?>
</body>
</html>
