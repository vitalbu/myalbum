<?php
use Myblog\App;
?>
<!DOCTYPE html>
<html lang="<?= App::$app->getProperty('language'); ?>" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/favicon.png" type="image/x-icon">
</head>
<body>
<div style="text-align: center;">

    <div style="text-align:center;"><img alt="404" src="/errors/images/404.png" style="width:60%;text-align:center;" /></div><br/>
    <div><a href="/">Go back to Home</a></div>
</div>
</body>
</html>
