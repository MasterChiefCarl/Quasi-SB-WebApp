<?php

    interface IConsumable {
        public function setPrice(int $price);
        public function getPrice() : int;      
        public function setConsumableName(string $consName);
        public function getConsumableName() : string;  
    }

