<?php
    declare(strict_types = 1);
    require_once 'php/Session.php';

    use Sessions\Session;
    Session::start();
    class Cart implements iCart {
        public function addToCart($orders, $ordQty)
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
                'consPrice' => $orderedItem->getPrice(),
                'consQty' => $ordQty
                );
                array_push($tmpValue, $itemData);
                Session::add('cart', $tmpValue);                
            }
            else {
                $orderedItems[0] = array('consName' => $orderedItem->getConsumableName(),
                'consType' => $orderedItem->getConsType(),
                'consPrice' => $orderedItem->getPrice(),
                'consQty' => $ordQty
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
            
        }
    }