<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Product;

class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = \R::findOne('product', 'alias = ? AND status = "1"', [$alias]);

        if (! $product) {
            throw new \Exception("Товар {$alias} не найден!", 500);
        }

        // хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

        // связанные товары
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);

        // запись в куки запрошенного товара
        $productModel = new Product();
        $productModel->setRecentlyViewed($product->id);

        // просмотренные товары
        $productViewed = $productModel->getRecentlyViewed();
        $recentlyViewed = null;

        if ($productViewed) {
            $recentlyViewed = \R::find('product', 'id IN (' . \R::genSlots($productViewed)  . ') LIMIT 3', $productViewed);
        }

        // галерея
        $gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);

        // модификации
        $mods = \R::findAll('modification', 'product_id = ?', [$product->id]);

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'breadcrumbs', 'mods'));
    }
}