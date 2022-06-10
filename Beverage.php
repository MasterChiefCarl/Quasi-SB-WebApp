<?php

    declare(strict_types = 1);

    class Beverage implements IConsumable {
        protected int $price; 
        protected string $beverageName;
        protected string $beverageSize;

        public function setPrice (int $price) {
            $this->price = $price;
        }

        public function getPrice () : int {
            return $this->price;
        }

        public function setBeverageName (string $beverageName) {
            $this->beverageName = $beverageName;
        }

        public function getBeverageName () : string {
            return $this->beverageName;
        }

        public function setBeverageSize (string $beverageSize) {
            $this->beverageSize = $beverageSize;
        }

        public function getBeverageSize () : string {
            return $this->beverageSize;
        }

    }