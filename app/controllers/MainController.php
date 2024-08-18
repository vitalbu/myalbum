<?php

namespace app\controllers;

use Myblog\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta('Главная страница', 'Описание...', 'Ключевики...');
    }

}