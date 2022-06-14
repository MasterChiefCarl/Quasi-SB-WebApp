<?php

    declare(strict_types = 1);

    class Wrap extends Food {
        
        public function __construct(string $foodName, string $consType, float $price) {
            parent::__construct($foodName, $consType, $price);
        }
    }