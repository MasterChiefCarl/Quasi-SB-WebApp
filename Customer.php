<?php 
    
    declare(strict_types = 1);
    
    class Customer implements ICustomer {
        private string $custName;
        private array $orders;
        private int $ordQty;

        public function setCustName (string $custName) {
            $this->custName = $custName;
        }

        public function getCustName () : string {
            return $this->custName;
        }

        public function setOrders(array $orders) {
            array_push($this->orders, $orders);
        }
        public function getOrders() : array {
            return $this->orders;
        }

        public function setOrdQty(int $ordQty) {
            $this->ordQty = $ordQty;
        }

        public function getOrdQty() : int {
            return $this->ordQty;
        }
    }