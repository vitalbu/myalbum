<?php

use Myblog\App;

/* @var $content string */
?>
<!DOCTYPE html>
<html lang="<?= App::$app->getProperty('language'); ?>" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/favicon.png" type="image/x-icon">

    <?=$this->getMeta();?>

    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
</head>
<body class="d-flex flex-column h-100">

<header>
    <nav id="w0" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/"><?= App::$app->getProperty('name'); ?></a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w0-collapse"
                    aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav me-auto mb-2 mb-md-0 nav">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/album/">Альбомы</a></li>
                </ul>
                <?php if(!empty($_SESSION['user'])): ?>
                    <div class="d-flex accost">Добро пожаловать, <?= h($_SESSION['user']['name']) ?></div>
                    <div class="d-flex"><a class="btn btn-link login text-decoration-none" href="/user/logout">Выход</a></div>
                <?php else: ?>
                    <div class="d-flex"><a class="btn btn-link login text-decoration-none" href="/user/signup">Signup</a></div>
                    <div class="d-flex"><a class="btn btn-link login text-decoration-none" href="/user/login">Login</a></div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="site-index">

            <div class="body-content">

                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?= $content; ?>

            </div>
        </div>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= App::$app->getProperty('name'); ?> <?= date('Y') ?></p>
        <p class="float-end">Powered by <a href="/" rel="external"><?= App::$app->getProperty('name'); ?></a></p>
    </div>
</footer>


<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.bundle.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
