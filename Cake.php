<?php

    declare(strict_types = 1);

    class Cake extends Food {
        private int $ordQty;        

        public function setOrdQty (int $ordQty) {
            $this->ordQty = $ordQty;
        } 

        public function getOrdQty () : int {
            return $this->ordQty;
        }
    }