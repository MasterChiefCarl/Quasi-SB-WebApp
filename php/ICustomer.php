<?php

    interface ICustomer {
        public function setCustName(string $custName);
        public function getCustName() : string;
    }