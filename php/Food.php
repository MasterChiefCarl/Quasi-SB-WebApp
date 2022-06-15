<?php

    declare(strict_types = 1);

    class Food implements IConsumable {
        protected float $price;
        protected string $foodName;
        protected string $consType;

        public function __construct(string $foodName, string $consType, float $price)
        {
            $this->foodName = $foodName;
            $this->consType = $consType;
            $this->price = $price;
        }

        public function getPrice () : float {
            return $this->price;
        }

        public function getConsumableName () : string {
            return $this->foodName;
        }

        public function getConsType () : string {
            return $this->consType;
        }
        
    }