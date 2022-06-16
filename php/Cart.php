<?php
    declare(strict_types = 1);
    require_once 'php/Session.php';

    use Sessions\Session;
    Session::start();
    class Cart implements iCart {
        private array $orderList;
        private $totalAmount = 0;

        public function addToCart($orders)
        {           

            if ($orders['consID'] == '1') {
                $orderedItem = new Beverage($orders['prodName'], $orders['subconsID'], (float)$orders['prodPrice']);
            }
            else if ($orders['consID'] == '2') {
                $orderedItem = new Food($orders['prodName'], $orders['subconsID'], (float)$orders['prodPrice']);
            }

            if(Session::has('cart')) {;
                $tmpValue = $this->getCart();
                $itemData = array('consName' => $orderedItem->getConsumableName(),
                'consType' => $orderedItem->getConsType(),
                'consPrice' => $orderedItem->getPrice()
                );
                array_push($tmpValue, $itemData);
                Session::add('cart', $tmpValue);
                // array_push($_SESSION['cart']['consName'], $orderedItem->getConsumableName());
                // array_push($_SESSION['cart']['consType'], $orderedItem->getConsType());
                // array_push($_SESSION['cart']['consPrice'], $orderedItem->getPrice());
            }
            else {
                $orderedItems[0] = array('consName' => $orderedItem->getConsumableName(),
                'consType' => $orderedItem->getConsType(),
                'consPrice' => $orderedItem->getPrice()
                );

                // $_SESSION['cart']['consName'] = $orderedItem->getConsumableName();
                // $_SESSION['cart']['consType'] = $orderedItem->getConsType();
                // $_SESSION['cart']['consPrice'] = $orderedItem->getPrice();
                Session::add('cart', $orderedItems);             
            }
        }

        public function removeFromCart($item)
        {
            Session::remove('cart', $item);
        }

        public function getCart() : array
        {
            return Session::get('cart');
        }

        public function placeOrder()
        {
            return Session::stop();
        }

        public function calculateBill()
        {
            
        }
    }