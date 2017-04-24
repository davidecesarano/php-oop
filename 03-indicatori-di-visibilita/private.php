<?php 
    
    class Person {
    
        private $name;

        public function __construct($name){
            $this->name = $name;
        }

        private function getPrivateName(){
            return $this->name;
        }

        public function getName(){
            return $this->name;
        }
    
    }
  
    $persona = new Person('Mario Rossi');
    echo $persona->getName(); // Mario Rossi
    echo $persona->name; // Errore
    echo $persona->getPrivateName(); // Errore