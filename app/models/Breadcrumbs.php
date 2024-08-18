<?php

namespace app\models;

use Myblog\App;

class Breadcrumbs
{

    public static function getBreadcrumbs($table, $id, $name = '')
    {
        if (isset($table) && isset($id)) {
            $model = \R::load($table, $id);
        }

        $breadcrumbs = "<li><a href='" . PATH . "'>Главная</a></li>";

        if (isset($model->title)) {
            $breadcrumbs .= "/<li><a href='" . PATH . "/album'>Альбомы</a></li>";
            $breadcrumbs .= "/<li>" . h($model->title) . "</li>";
        }

        if ($name) {
            $breadcrumbs .= "/<li>$name</li>";
        }
        return $breadcrumbs;
    }

    public static function getParts($cats, $id)
    {
        if (!$id) return false;
        $breadcrumbs = [];
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $breadcrumbs[$cats[$id]['alias']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else break;
        }
        return array_reverse($breadcrumbs, true);
    }

}