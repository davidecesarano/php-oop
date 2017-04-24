<?php 
    
    class Person {
        
        public $name;
        
        public function __construct($name){
            $this->name = $name;
        }
        
        public function getName($name){
            return $this->name;
        }
        
    }
    
    class Student extends Person {
        
        public $surname;
        
        public function __construct($name, $surname){
            
            /**
             * per accedere al metodo __construct 
             * della classe Person utilizziamo 
             * la keyword parent
             */
            parent::__construct($name);
            $this->surname = $surname;
            
        }
        
        public function getName(){
            return $this->name.' '.$this->surname;
        }
        
    }
    
    $student = new Student('Mario', 'Rossi');
    echo $student->getName(); // Mario Rossi
    
    $person = new Person('Mario Rossi');
    echo $person->getName(); // Mario Rossi