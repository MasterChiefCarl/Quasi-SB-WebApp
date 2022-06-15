<?php

    declare(strict_types = 1);

    class Cake extends Food {

        public function __construct(string $foodName, string $consType, float $price) {
            parent::__construct($foodName, $consType, $price);
        }
    }