<?php

    declare(strict_types = 1);

    class Beverage implements IConsumable {
        protected float $price; 
        protected string $beverageName;
        protected string $consType;  

        public function __construct(string $beverageName, string $consType, float $price)
        {
            $this->beverageName = $beverageName;
            $this->consType = $consType;
            $this->price = $price;
        }

        public function getPrice () : float {
            return $this->price;
        }

        public function getConsumableName () : string {
            return $this->beverageName;
        }

        public function getConsType () : string {
            return $this->consType;
        }

    }