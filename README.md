# Programmazione a oggetti con PHP
* [Le Basi](https://github.com/davidecesarano/php-oop#le-basi)
  * [Creare una classe](https://github.com/davidecesarano/php-oop#creare-una-classe)
  * [Istanziare un oggetto della classe](https://github.com/davidecesarano/php-oop#istanziare-un-oggetto-della-classe)
  * [Estendere una classe](https://github.com/davidecesarano/php-oop#estendere-una-classe)
  * [Risoluzione del nome della classe](https://github.com/davidecesarano/php-oop#risoluzione-del-nome-della-classe)
* [Costruttore e distruttore](https://github.com/davidecesarano/php-oop#costruttore-e-distruttore)
* [Indicatori di visibilità](https://github.com/davidecesarano/php-oop#indicatori-di-visibilit%C3%A0)
  * [public](https://github.com/davidecesarano/php-oop#public)
  * [private](https://github.com/davidecesarano/php-oop#private)
  * [protected](https://github.com/davidecesarano/php-oop#protected)
* [Static Keyword](https://github.com/davidecesarano/php-oop#static-keyword)
* [Costanti](https://github.com/davidecesarano/php-oop#costanti)
* [Caricamento automatico delle classi](https://github.com/davidecesarano/php-oop#caricamento-automatico-della-classi)
* [Namespace](https://github.com/davidecesarano/php-oop#namespace)
* [Ereditarietà](https://github.com/davidecesarano/php-oop#ereditariet%C3%A0)
  * [Overriding](https://github.com/davidecesarano/php-oop#overriding)
  * [Final](https://github.com/davidecesarano/php-oop#final)
* [Traits](https://github.com/davidecesarano/php-oop#traits)
* [Classi astratte](https://github.com/davidecesarano/php-oop#classi-astratte)
* Interfacce
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
## Static Keyword
Le proprietà e i metodi statici non appartengono a nessuna istanza, ma sono di fatto componenti statiche della classe stessa. Per richiamarle occorre usare l'operatore di risoluzione dell'ambito (::) oppure la keyword *self*.

```php
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

## Namespace
Un namespace è assimilabile alla struttura delle cartelle di un filesystem: dobbiamo dichiarare un’origine per il nostro namespace che corrisponde alla directory root e possiamo inserire in maniera sequenziale una serie di suddivisioni che in questa similitudine rappresenterebbero le sottocartelle.

```php
    // Country/Italy.php
    namespace Country;
    
    class Italy {
        
        public function getCampania(){
            return 'Campania';
        }
        
    }
```
```php
    include 'Country/Italy.php';
    
    use Country\Italy;
    
    class Person {
        
        protected $italy;
        
        public function __construct(){
            $this->italy = new Italy;
        }
        
        public function getRegion(){
            return $this->italy->getCampania();
        }
        
    }
    
    $person = new Person;
    echo $person->getRegion(); // Campania
```

## Ereditarietà
Tramite l'ereditarietà (*inheritance*), una classe (classe figlia), può ereditare sia i metodi che le proprietà da un'altra classe (classe genitore). Inoltre, la nuova classe figlia, può definire nuove proprietà e metodi, oppure, ridefinire metodi della classe genitore. 

```php
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
```

### Overriding
I metodi definiti in una classe genitore, possono essere sovrascritti (*overriding*) in una classe figlia e, in questo caso, le funzioni ridefinite avranno precedenza su quelle della classe genitore.

```php
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
    echo $person->getName();
```

### Final
E' possibile impedire che la classe (o dei metodi della classe) sia estesa, utilizzando la parola chiave *final* prima della definizione del metodo o della classe.

```php
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
```

## Traits
Un trait è uno snippet di codice che viene incluso in una classe per aggiungere delle funzionalità (comportamenti) alla classe stessa. Nel corpo del trait è possibile definire tutto quello che verrebbe definito in una classe quindi sia metodi che proprietà che risulteranno accessibili dalle classi che useranno il trait. I metodi possono essere definiti come public, protected e private. Possono essere definiti come static e come abstract.

```php
    // trait
    trait HTML {
        
        public function p($string){
            return "<h1>$string</h1>";
        }
    
    }
    
    // classe
    class Student {
        
        // richiamo trait
        use HTML;
        
        public $name;
        
        public function __construct($name){
            $this->name = $name;
        }
        
        public function getName(){
            return $this->p($this->name);
        }
        
    }
    
    $student = new Student('Mario Rossi');
    echo $student->getName(); // Mario Rossi
```

Due trait utilizzati nella stessa classe potrebbero definire metodi o proprietà con lo stesso nome: in questo caso l'interprete PHP restituirebbe un errore. Per evitarlo è possibile modificare la modalità di importazione con un costrutto più complesso di *use*.

```php
    trait ITA {
        
        public function hello(){
            return 'Ciao';
        }
        
    }
    
    trait ENG {
            
        public function hello(){
            return 'Hello <br />';
        }
        
    }
    
    class Speak {
        
        use ITA, ENG {
            ENG::hello insteadof ITA;
            ITA::hello as ciao;
        }
        
    }
    
    $speak = new Speak;
    echo $speak->hello(); // Hello
    echo $speak->ciao(); // Ciao
```

## Classi astratte
Una classe astratta è definibile come un particolare tipo di classe la quale non può essere istanziata, cioè non è possibile creare un oggetto da una classe astratta, ma può solo essere estesa da un'altra classe. I metodi astratti della classe astratta dovranno essere (necessariamente) ridefiniti da una sottoclasse per poter essere utilizzati.

```php
    abstract class Person {
        
        public $name;
        
        public function setName($name){
            $this->name = $name;
        }
        
        abstract public function getName();
        
    }
    
    class Student extends Person {
        
        public function __construct($name){
            $this->setName($name);
        }
        
        public function getName(){
            return $this->name;
        }
    
    }
    
    $student = new Student('Mario Rossi');
    echo $student->getName(); // Mario Rossi
```
