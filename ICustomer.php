<?php

    interface ICustomer {
        public function setCustName(string $custName);
        public function getCustName() : string;
        public function setOrders(array $orders);
        public function getOrders() : array;
        public function setOrdQty(int $ordQty);
        public function getOrdQty() : int;
    }