<?php

namespace app\controllers;

use app\models\AppModel;
use Myblog\App;
use Myblog\base\Controller;
use Myblog\Cache;

class AppController extends Controller
{

    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
    }

    public static function cacheCategory()
    {
        $cache = Cache::instance();
        $cats = $cache->get('cats');
        if (!$cats) {
            $cats = \R::getAssoc("SELECT * FROM category");
            $cache->set('cats', $cats);
        }
        return $cats;
    }

}