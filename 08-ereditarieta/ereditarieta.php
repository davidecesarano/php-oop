<?php 
    
    class Person {
    
        protected $id;
        public $name;
        private $password;
        
        public function setId(){
            $this->id = 1;
        }
        
        public function getName(){
            return $this->name;
        }
    
    }
  
    class Student extends Person {
   
        public function __construct($name){
            
            $this->name = $name;
            $this->setId();
        
        }
    
        public function getId(){
            return $this->id;
        }
  
    }
  
    $student = new Student('Mario Rossi');
    echo $student->getName(); // Mario Rossi
    echo $student->name; // Mario Rossi
    echo $student->getId(); // 1
    echo $student->id; // Errore (proprietà protected)
    echo $student->password; // Errore (proprietà private)