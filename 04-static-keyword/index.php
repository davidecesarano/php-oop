<?php 
    
    class Color {
    
        public static $red = 'Red';
        
        public static function getRed(){
            return self::$red;
        }
        
        public function red(){
            return self::$red;
        }
        
    }
    
    echo Color::getRed(); // Red
    $color = new Color;
    echo $color->red(); // Red