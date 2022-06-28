<?php

    interface IConsumable {       
        public function getPrice() : float;      
        public function getConsumableName() : string;  
        public function getConsType() : string;
    }

