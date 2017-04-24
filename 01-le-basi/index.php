<?php 
    
    class Person {
    
        // proprietà
        public $name;
    
        // costruttore
        public function __construct($name){
            $this->name = $name;
        }
    
        // metodo
        public function getName(){
            return $this->name;
        }

    }
    
    $persona = new Person('Mario Rossi');
    echo $persona->getName(); // Mario Rossi