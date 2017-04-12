# Programmazione a oggetti con PHP
* [Le Basi](https://github.com/davidecesarano/php-oop#le-basi)
  * [Creare una classe](https://github.com/davidecesarano/php-oop#creare-una-classe)
  * Istanziare un oggetto della classe
  * Estendere una classe
  * Risoluzione del nome della classe
* Costruttore e distruttore
* Indicatori di visibilità
  * public
  * private
  * protected
* Costanti
* Caricamento automatico delle classi
* Namespace
* Ereditarietà
* Classi astratte
* Interfacce
* Traits
* Overloading
* Clonazione
* Metodi magici
* Iterazione
* Classi Anonime
* Introspection
* Reflection
* PHPDoc

## Le Basi

### Creare una classe

```php
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
```

### Istanziare un oggetto della classe

```php
  $persona = new Person('Mario Rossi');
  echo $persona->getName(); // Mario Rossi
```

### Estendere una classe

```php
  class Student extends Person {
    //...
  }
```

### Risoluzione del nome della classe

Con *::class* si può ottenere una stringa contenente il nome completo della classe: questo è particolarmente utile con le classi presenti nei namespace.

```php
  namespace Europe {
    class Italy {
      //...
    }
    echo Italy::class; // Europe\Italy;
  }
```

## Costruttore e Distruttore

```php
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
```

## Indicatori di visibilità

### public
Proprietà o metodi accessibili sia dall'interno che dall'esterno della classe e dalle classi derivate da essa.
```php
  class Person {
    
    public $name;
    
    public function __construct($name){
      $this->name = $name;
    }
    
    public function getName(){
      return $this->name;
    }
    
  }
  
  $persona = new Person('Mario Rossi');
  echo $persona->name; // Mario Rossi
  echo $persona->getName(); // Mario Rossi
```  

### private
Proprietà o metodi utilizzati soltanto all'interno della classe stessa.
```php
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
```  

### protected
Proprietà o metodi che possono essere utilizzati all'interno della classe stessa e all'interno delle classi derivate, ma non sono accessibili dall'esterno della classe.
```php
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
```

## Costanti
```php
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
```

## Caricamento automatico della classi
```php
  // MyClass1.php
  class MyClass1 {}
```
```php
  // MyClass2.php
  class MyClass2 {}
```
```php
  // autoload.php
  spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
  });

  $obj  = new MyClass1();
  $obj2 = new MyClass2(); 
```
