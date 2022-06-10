<?php


namespace app\controllers\admin;


use myframework\libs\Pagination;

class OrderController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 1;
        $count = \R::count('order');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`, `order`.`date`, `order`.`update_at`,
    `order`.`currency`, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` 
    FROM `order` 
    JOIN `user` ON `order`.`user_id` = `user`.`id` 
    JOIN `order_product` ON `order`.`id` = `order_product`.`order_id` 
    GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");
//        debug($orders);

        $this->setMeta('list orders');
        $this->set(compact('orders', 'pagination', 'count'));
    }

    public function viewAction()
    {
        $order_id = $this->getRequestId();
        $order = \R::getRow("SELECT `order`.*, `user`.`name`, ROUND(SUM(`order_product`.`price`), 2) AS `sum` 
    FROM `order` 
    JOIN `user` ON `order`.`user_id` = `user`.`id` 
    JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`    
    WHERE `order`.`id` = ?
    GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT 1", [$order_id]);

        if (! $order) {
            throw new \Exception("Order not found", 404);
        }

        $orderProducts = \R::findAll('order_product', 'order_id = ?', [$order_id]);

        $this->setMeta("Order №($order_id)");
        $this->set(compact('order', 'orderProducts'));
    }
}