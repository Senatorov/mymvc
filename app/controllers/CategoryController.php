<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use myframework\App;
use myframework\libs\Pagination;

class CategoryController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);
        if (! $category) {
            throw new \Exception('Страница не найдена', 404);
        }

        // хлебная окрошка
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);

        $catModel = new Category();
        $ids = $catModel->getIds($category->id);
        $ids = ! $ids ? $category->id : $ids . $category->id;

        // пагинация
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');
        $total = \R::count('product', "category_id IN ({$ids})");
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $products = \R::find('product', "category_id IN ({$ids}) LIMIT {$start}, {$perpage}");
        $this->setMeta($category->title, $category->description, $category->keywords);
        // разобраться что передают здесь
        $this->set(compact('products', 'breadcrumbs', 'pagination', 'total'));
    }
}