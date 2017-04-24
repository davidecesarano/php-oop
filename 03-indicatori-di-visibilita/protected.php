<?php 
    
    class Person {
        protected $name;
    }

    class Student extends Person {

        public function setName($name){
            $this->name = $name;
        }

        public function getName(){
            return $this->name:
        }
    
    }
  
    $student = new Student;
    $student->setName('Mario Rossi');
    echo $student->getName(); // Mario Rossi
    echo $student->name; // Errore