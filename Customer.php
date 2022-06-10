<?php 
    
    declare(strict_types = 1);
    
    class Customer implements ICustomer {
        private string $custName;

        public function setCustName (string $custName) {
            $this->custName = $custName;
        }

        public function getCustName () : string {
            return $this->custName;
        }
    }