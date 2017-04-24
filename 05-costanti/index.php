<?php 
    
    class Color {
    
        const RED = 'Red';
        const BLACK = 'Black';

        public function getAll(){
            echo self::RED.', ';
            echo Color::BLACK;
        }
    
    }
  
    $color = new Color;
    $color->getAll(); // Red, Black
    echo Color::Red; // Red