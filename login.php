<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

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
                    <div class="col-md-8">
                        <?php if(isset($_COOKIE['reg_complete']) && $_COOKIE['reg_complete'] == '1'): ?>
                            <div class="alert alert-success" role="alert">
                                РЕГИСТРАЦИЯ ПРОШЛА УСПЕШНО
                            </div>
                        <?php endif; ?>
                        <div class="card">
                            <div class="card-header">Login</div>

                            <div class="card-body">
                                <form method="POST" action="./?page=signin">

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control <?= @$_COOKIE['email_error'];?> " name="email"  autocomplete="email" autofocus >
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= @$_COOKIE['check_signin']?></strong>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control <?= @$_COOKIE['pass_error'];?>" name="password"  autocomplete="current-password">
                                            <span class="invalid-feedback" role="alert">
                                                    <strong><?= @$_COOKIE['check_signin']?></strong>
                                                </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" >

                                                <label class="form-check-label" for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                               Login
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
