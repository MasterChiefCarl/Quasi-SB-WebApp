<?php

    interface iCart {
        public function addToCart($orders, $ordQty);
        public function removeFromCart($item);
        public function getCart() : array;
        public function placeOrder();
        public function calculateBill();
    }