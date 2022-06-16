<?php
    declare(strict_types = 1);
    require_once 'php/Session.php';

    use Sessions\Session;
    if (session_status() === PHP_SESSION_NONE) {
        Session::start();
    }
    class Cart implements iCart {
        private $totalBill = 0;
        private $cartCollection = [];

        public function addToCart($orders, $ordQty, $itemSizeAdd)
        {           

            if ($orders['consID'] == '1') {
                $orderedItem = new Beverage($orders['prodName'], $orders['subconsID'], (float)$orders['prodPrice']);
            }
            else if ($orders['consID'] == '2') {
                $orderedItem = new Food($orders['prodName'], $orders['subconsID'], (float)$orders['prodPrice']);
            }

            if (Session::has('cart')) {
            if(count(Session::get('cart')) == 0) {
                echo 'true';
                unset($_SESSION['cart']);
                var_dump($_SESSION['cart']);
            }
            }

            if(Session::has('cart')) {       
                echo "HI";         
                $tmpValue = $this->getCart();
                $itemData = array('consName' => $orderedItem->getConsumableName(),
                'consType' => $orderedItem->getConsType(),
                'consPrice' => $orderedItem->getPrice(),
                'consQty' => (int)$ordQty,
                'consSizeAdd' => (float)$itemSizeAdd
                );
                array_push($tmpValue, $itemData);
                Session::add('cart', $tmpValue);                
            }
            else {                
                $orderedItems[0] = array('consName' => $orderedItem->getConsumableName(),
                'consType' => $orderedItem->getConsType(),
                'consPrice' => $orderedItem->getPrice(),
                'consQty' => (int)$ordQty,
                'consSizeAdd' => (float)$itemSizeAdd
                );    
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
            if (Session::has('cart')) {
                $this->cartCollection = $this->getCart();

                foreach($this->cartCollection as $collectionCol) {
                    $this->totalBill += ($collectionCol['consPrice'] + $collectionCol['consSizeAdd']) * $collectionCol['consQty'];
                }
            }
            return '₱ '.$this->totalBill.'.00';
        }
    }