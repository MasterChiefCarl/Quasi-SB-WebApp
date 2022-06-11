<?php

    declare(strict_types = 1);

    class Food implements IConsumable {
        protected int $price;
        protected string $foodName;
        protected string $foodType;

        public function setPrice (int $price) {
            $this->price = $price;
        }

        public function getPrice () : int {
            return $this->price;
        }

        public function setConsumableName (string $foodName) {
            $this->foodName = $foodName;
        }

        public function getConsumableName () : string {
            return $this->foodName;
        }

        public function setFoodType (string $foodType) {
            $this->foodType = $foodType;
        }

        public function getFoodType () : string {
            return $this->foodType;
        }
        
    }