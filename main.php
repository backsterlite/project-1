
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Комментарии</h3></div>

                        <div class="card-body">
                            <?php if(isset($_COOKIE['send']) && $_COOKIE['send'] == "1"): ?>
                            <div class="alert alert-success" role="alert">
                                Комментарий успешно добавлен
                            </div>
                            <?php endif; ?>
                            <?php   foreach($posts as $post): ?>
                            <div class="media">
                                <img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">
                                <div class="media-body">
                                    <h5 class="mt-0"><?= $post['nickname'];?></h5>
                                    <span><small><?= date("d/m/y",strtotime($post['time']));?></small></span>
                                    <p>
                                        <?= $post['content'];?>
                                    </p>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Оставить комментарий</h3></div>

                        <div class="card-body">
                            <form action="./?page=store" method="post">
                                <?php if($_SESSION['log_complete'] != '1'): ?>
                                <div class="form-group">

                                    <label for="exampleFormControlTextarea1">Имя</label>
                                    <div class="col-md-6">
                                        <input name="nickname" class="form-control <?= @$_COOKIE['empty_nickname'] ?>" id="exampleFormControlTextarea1" />
                                        <span class="invalid-feedback " role="alert">
                                                    <strong>Заполните поле</strong>
                                                </span>
                                    </div>

                                </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Сообщение</label>
                                    <div class="col-md-6">
                                        <textarea name="content" class="form-control <?= @$_COOKIE['empty_content'];?>" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        <span class="invalid-feedback " role="alert">
                                                    <strong>Заполните поле</strong>
                                                </span>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-success">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php debug($_COOKIE);  debug($_SESSION);?>
</body>
</html>
