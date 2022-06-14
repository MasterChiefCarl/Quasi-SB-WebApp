<?php

    interface iCart {
        public function addToCart($orders);
        public function removeFromCart($item);
        public function getCart() : array;
        public function placeOrder();
        public function calculateBill();
    }