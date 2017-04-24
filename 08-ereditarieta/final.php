<?php 
    
    class Eng {
        
        final public function hello(){
            return 'Hello';
        }
        
    }
    
    class Speak extends Eng {
        
        /**
         * Errore, non è possibile
         * sovrascrivere il metodo
         */
        public function hello(){
            return 'Ciao';
        }
        
    }