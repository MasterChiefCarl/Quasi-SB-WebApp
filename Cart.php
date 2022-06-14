<?php
    declare(strict_types = 1);

    require_once 'init.php';
    use Sessions\Session;

    class Cart implements iCart {
        private array $orderList;
        private $totalBill = 0;

        public function addToCart($orders)
        {
            $orderedItem = [];

            if ($orders['consID'] == '1') {
                $orderedItem = new Food($orders['prodName'], $orders['prodType'], $orders['prodPrice']);
            }
            else if ($orders['consID'] == '2') {
                $orderedItem = new Beverage($orders['prodName'], $orders['prodType'], $orders['prodPrice']);
            }

            if(!Session::has('cart')) {
                $_SESSION['cart'][0]['consName'] = $orderedItem->getConsumableName();
                $_SESSION['cart'][0]['consType'] = $orderedItem->getConsType();
                $_SESSION['cart'][0]['consPrice'] = $orderedItem->getPrice();
            }
            else {
                array_push($_SESSION['cart']['consName'], $orderedItem->getConsumableName());
                array_push($_SESSION['cart']['consType'], $orderedItem->getConsType());
                array_push($_SESSION['cart']['consPrice'], $orderedItem->getPrice());
            }
        }

        public function removeFromCart($item)
        {
            Session::remove('cart', $item);
        }

        public function getCart() : array
        {
            $this->orderList = Session::get('cart');
            return $this->orderList;
        }

        public function placeOrder()
        {
            return Session::stop();
        }

        public function calculateBill()
        {
            
        }
    }