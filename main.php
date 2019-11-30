<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Main</title>

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
                <?php if( isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '1' && isset($_SESSION['user']) && $_SESSION['user'] == ADMIN): ?>
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li></li>
                </ul>
                <!-- Right Side Of Navbar -->
                <div class="btn-group">
                    <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['user']?>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/?page=logout&log=exit">Logout</a>
                        <a class="dropdown-item" href="/?page=profile">Profile</a>
                        <a class="dropdown-item" href="/?page=admin">Admin</a>
                    </div>
                </div>
                <?php elseif(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '1'): ?>
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li></li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <div class="btn-group">
                        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['user']?>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/?page=logout&log=exit">Logout</a>
                            <a class="dropdown-item" href="/?page=profile">Profile</a>
                        </div>
                    </div>

                <?php else: ?>
                    <ul class="navbar-nav ml-auto">
                        <li></li>
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
                            <?php elseif(isset($_COOKIE['send']) && $_COOKIE['send'] == "2"): ?>
                                <div class="alert alert-danger" role="alert">
                                    Произошла ошибка
                                </div>
                            <?php endif; ?>
                            <?php   foreach($posts as $post): ?>
                                <?php if($post['alow'] == 1): ?>
                                <div class="media">
                                    <img src="<?php if($post['avatar_path'] == ""){ echo 'img/no-user.jpg';}else{echo strstr(str_replace('\\', '/',$post['avatar_path']), '/profile') ;/*$post['avatar_path'];*/}?>" class="mr-3" alt="..." width="64" height="64">
                                    <div class="media-body">
                                        <h5 class="mt-0"><?= $post['login'];?></h5>
                                        <span><small><?= date("d/m/y",strtotime($post['time']));?></small></span>
                                        <p>
                                            <?= nl2br($post['content']);?>
                                        </p>
                                    </div>
                                </div>
                                <?php else : continue; ?>
                            <?php endif; ?>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Оставить комментарий</h3></div>

                        <div class="card-body">
                            <?php if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] != '1' || !isset($_SESSION['log_complete'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    Комментарии доступны только зарегестрированым пользователям
                                    <a class="nav-link" href="/?page=register">Зарегестрироваться</a> или
                                    <a class="nav-link" href="/?page=login">Войти</a>
                                </div>
                            <?php else: ?>
                                <form action="./?page=store" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Сообщение</label>
                                        <div class="col-md-6">
                                            <textarea name="content" class="form-control <?= @$_COOKIE['empty_content'];?>" id="exampleFormControlTextarea1" rows="3" aria-required="true"></textarea>
                                            <span class="invalid-feedback " role="alert">
                                                    <strong>Заполните поле</strong>
                                                </span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Отправить</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>