# Programmazione a oggetti con PHP
* Le basi
* Costruttori e distruttori
* Proprietà e Indicatori di visibilità
* Costanti
* Caricamento automatico delle classi
* Namespace
* Ereditarietà
* Classi astratte
* Interfacce
* I Traits
* Overloading
* Clonare gli oggetti
* Metodi magici
* Iterazione
* Classi Anonime
* Introspection
* Reflection
* PHPDoc

## Le basi

```php
  class Persona {
    
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
  
  // instanzia un nuovo oggetto della classe Persona
  $persona = new Persona('Mario Rossi');
  
  // stampa il nome
  echo $persona->getName();
  
```
