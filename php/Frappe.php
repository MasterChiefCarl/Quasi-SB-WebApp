<?php

    declare(strict_types = 1);

    class Frappe extends Beverage {
        
        public function __construct (string $beverageName, string $consType, float $price) {
            parent::__construct($beverageName, $consType, $price);
        }
        
    }