<?php 

    include 'Country/Italy.php';
    
    use Country\Italy;
    
    class Person {
        
        protected $italy;
        
        public function __construct(){
            $this->italy = new Italy;
        }
        
        public function getRegion(){
            return $this->italy->getCampania();
        }
        
    }
    
    $person = new Person;
    echo $person->getRegion();
    