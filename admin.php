<?php
if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '1')
{
    if(isset($_SESSION['user']) && $_SESSION['user'] != ADMIN)
    {
        header('Location: /');
        exit;
    }
}
if(isset($_SESSION['log_complete']) && $_SESSION['log_complete'] == '0')
{
header('Location: /');
exit;
}
if(!isset($_SESSION['log_complete']))
{
header('Location: /');
exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

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
                            <div class="card-header"><h3>Админ панель</h3></div>

                            <div class="card-body">
                                <?php if(isset($_COOKIE['send']) && $_COOKIE['send'] == "1"): ?>
                                    <div class="alert alert-success" role="alert">
                                        Изменения сохранены
                                    </div>
                                <?php elseif(isset($_COOKIE['send']) && $_COOKIE['send'] == "0"): ?>
                                    <div class="alert alert-danger" role="alert">
                                        Произошла ошибка
                                    </div>
                                <?php endif; ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Имя</th>
                                            <th>Дата</th>
                                            <th>Комментарий</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <?php   foreach($posts as $post): ?>
                                    <tbody>
                                        <tr>

                                            <td>
                                                <img src="<?php if($post['avatar_path'] == ""){ echo 'img/no-user.jpg';}else{echo strstr(str_replace('\\', '/',$post['avatar_path']), '/profile') ;/*$post['avatar_path'];*/}?>" alt="" class="img-fluid" width="64" height="64">
                                            </td>
                                            <td><?= $post['login'];?></td>
                                            <td><?= date("d/m/y",strtotime($post['time']));?></td>
                                            <td><?= nl2br($post['content']);?></td>

                                            <td>
                                                <?php   $valid = (isset($post['alow']) && $post['alow'] == 1)? "<a href='./?page=update&alow=0&id={$post['id']} ' class='btn btn-warning'>Запретить</a>": "<a href='./?page=update&alow=1&id={$post['id']}  ' class='btn btn-success'>Разрешить</a>"; echo $valid;?>
                                                <a href="./?page=update&delete=ok&id=<?= $post['id'];?>" onclick="return confirm('are you sure?')" class="btn btn-danger">Удалить</a>
                                            </td>

                                        </tr>

                                    </tbody>
                                    <?php endforeach;?>
                                </table>
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

</html>
