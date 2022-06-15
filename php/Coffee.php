<?php

    declare(strict_types = 1);

    class Coffee extends Beverage {

        public function __construct (string $beverageName, string $consType, float $price) {
            parent::__construct($beverageName, $consType, $price);
        }
        
    }