<?php

    declare(strict_types = 1);

    class Food implements IConsumable {
        protected int $price;
        protected string $foodName;

        public function setPrice (int $price) {
            $this->price = $price;
        }

        public function getPrice () : int {
            return $this->price;
        }

        public function setFoodName (string $foodName) {
            $this->foodName = $foodName;
        }

        public function getFoodName () : string {
            return $this->foodName;
        }
        
    }