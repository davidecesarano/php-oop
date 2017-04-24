<?php 
    
    class Person {
    
        public $name;

        public function __construct($name){
            $this->name = $name;
        }

        public function getName(){
            return $this->name;
        }
    
    }
  
    $persona = new Person('Mario Rossi');
    echo $persona->name; // Mario Rossi
    echo $persona->getName(); // Mario Rossi