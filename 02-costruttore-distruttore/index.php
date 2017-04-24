<?php 
    
    class Foo {
    
        // costruttore: richiamato nella fase di creazione dell'oggetto
        public function __construct(){
            echo "Costruttore... ";
        }

        // distruttore: richiamato prima che l'oggetto sia distrutto
        public function __destruct(){
            echo "...Distruttore.";
        }
    
    }
  
    $foo = new Foo; // Costruttore... ...Distruttore.