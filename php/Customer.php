<?php    
    declare(strict_types = 1);
    use Sessions\Session;
    
    class Customer implements ICustomer {
        private string $custName;

        public function setCustName(string $custName)
        {
            if(!Session::has('custName') or Session::has('custName')) {
                $_SESSION['custName'] = $custName;
            }
        }

        public function getCustName () : string {
            if(Session::has('custName')) {
                $this->custName = Session::get('custName');
                return $this->custName;
            }
            else
                return false;
        }
    }