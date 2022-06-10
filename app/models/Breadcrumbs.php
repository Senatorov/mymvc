<?php


namespace app\models;


use myframework\App;

class Breadcrumbs
{
    public static function getBreadcrumbs($categoryId, $name = '')
    {
        $cats = App::$app->getProperty('cats');
        $breadcrumbsArray = self::getParts($cats, $categoryId);
        $breadcrumbs = "<li><a href='" . PATH . "'>Home</a></li>";

        if ($breadcrumbsArray) {
            foreach ($breadcrumbsArray as $alias => $title) {
                $breadcrumbs .= "<li><a href='". PATH ."/category/{$alias}'>{$title}</a></li>";
            }
        }

        if ($name) {
            $breadcrumbs .= "<li>{$name}</li>";
        }

        return $breadcrumbs;
    }

    public static function getParts($cats, $id)
    {
        if (! $id) return false;

        $breadcrumbs = [];
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $breadcrumbs[$cats[$id]['alias']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else {
                break;
            }

        }

        return array_reverse($breadcrumbs, true);
    }
}