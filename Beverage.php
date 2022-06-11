<?php

    declare(strict_types = 1);

    class Beverage implements IConsumable {
        protected int $price; 
        protected string $beverageName;
        protected string $beverageSize;
        protected string $beverageType;

        public function setPrice (int $price) {
            $this->price = $price;
        }

        public function getPrice () : int {
            return $this->price;
        }

        public function setConsumableName (string $beverageName) {
            $this->beverageName = $beverageName;
        }

        public function getConsumableName () : string {
            return $this->beverageName;
        }

        public function setBeverageSize (string $beverageSize) {
            $this->beverageSize = $beverageSize;
        }

        public function getBeverageSize () : string {
            return $this->beverageSize;
        }

        public function setBeverageType (string $beverageType) {
            $this->beverageType = $beverageType;
        }

        public function getBeverageType () : string {
            return $this->beverageType;
        }

    }