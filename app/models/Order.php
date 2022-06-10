<?php


namespace app\models;


class Order extends AppModel
{
    public static function saveOrder($data)
    {}

    public static function saveOrderProduct($orderId)
    {}

    public static function mailOrder($orderId, $userEmail)
    {}
}