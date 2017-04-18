# Programmazione a oggetti con PHP

* [Introduzione](#introduzione)
* [Le Basi](#le-basi)
  * [Creare una classe](#creare-una-classe)
  * [Istanziare un oggetto della classe](#istanziare-un-oggetto-della-classe)
  * [Estendere una classe](#estendere-una-classe)
  * [Risoluzione del nome della classe](#risoluzione-del-nome-della-classe)
* [Costruttore e distruttore](#costruttore-e-distruttore)
* [Indicatori di visibilità](#indicatori-di-visibilit%C3%A0)
  * [public](#public)
  * [private](#private)
  * [protected](#protected)
* [Static Keyword](#static-keyword)
* [Costanti](#costanti)
* [Caricamento automatico delle classi](#caricamento-automatico-della-classi)
* [Namespace](#namespace)
* [Ereditarietà](#ereditariet%C3%A0)
  * [Overriding](#overriding)
  * [Final](#final)
* [Traits](#traits)
* [Classi astratte](#classi-astratte)
* [Interfacce](#interfacce)
* [Overloading](#overloading)
  * [Proprietà](p#propriet%C3%A0)
  * [Metodi](#metodi)
* [Clonazione](#clonazione)
  * [__clone()](#__clone)
* [Type Hinting](#type-hinting)
* Metodi magici
* [Iterazione](#iterazione)
  * [Iterator](#iterator)
  * [IteratorAggregate](#iteratoraggregate)
* [Classi Anonime](#classi-anonime)
* ArrayAccess
* Introspection
* Reflection
* Errori e Eccezioni
* PHPDoc

## Introduzione
Questo repository rappresenta una mini guida utile per imparare a sviluppare applicazioni in PHP sfruttando le potenzialità della Programmazione Orientata ad Oggetti (OOP). Per approfondimenti si rimanda a:
* [Programmazione a oggetti con PHP, la guida](http://www.html.it/guide/guida-programmazione-ad-oggetti-con-php-5/)
* [Manuale ufficiale PHP](http://php.net/manual/en/language.oop5.php)

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
Un trait è uno snippet di codice che viene incluso in una classe per aggiungere delle funzionalità (comportamenti) alla classe stessa. Nel corpo del trait è possibile definire tutto quello che verrebbe definito in una classe quindi sia metodi che proprietà che risulteranno accessibili dalle classi che useranno il trait. I metodi possono essere definiti come public, protected e private, static e abstract.

```php
    // trait
    trait HTML {
        
        public function h1($string){
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
            return $this->h1($this->name);
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

## Interfacce
Le interfacce sono delle classi che non possono essere istanziate ma soltanto implementate. Esse delineano la struttura di una classe, ma includono soltanto metodi (privi di implementazione) e costanti: non è possibile specificare le proprietà. Qualsiasi classe implementi un'interfaccia, avrà le costanti definite automaticamente e dovrà definire a suo volta i metodi dell'interfaccia, i quali, sono tutti sono astratti e vanno tutti implementati.

```php
    interface Person {
        
        public function setName($name);
        public function getName();
        
    }
    
    class Student implements Person {
        
        public $name;
        
        public function setName($name){
            $this->name = $name;
        }
        
        public function getName(){
            return $this->name;
        }
    
    }
    
    $student = new Student;
    $student->setName('Mario Rossi');
    echo $student->getName(); // Mario Rossi
```

E' possibile implementare diverse interfacce in un'unica classe:

```php
    class A implements B, C, D {
        //...
    }
```

Per le interfacce è possibile usare l’ereditarietà multipla. Un'interfaccia può estendere altre interfacce se queste non hanno nessun conflitto: ciò significa che se B definisce metodi già definiti in A si otterrà un errore.

```php
    interface A extends B, C, D {
        //...
    }
```
## Overloading
L'*overloading* in PHP fornisce gli strumenti per creare dinamicamente proprietà e metodi.

### Proprietà
L'*overloading* delle proprietà avviene mediante l'utilizzo di quattro metodi magici: **__set()**, **__get()**, **__isset()**, **__unset()**.

```php
    class Person {
        
        private $data = [];
        
        // scrive una proprietà non accessibile
        public function __set($name, $value){
            $this->data[$name] = 'Sto creando la proprietà '.$name.' con valore '.$value;
        }
        
        // legge una proprietà inaccessibile
        public function __get($name){
            
            if(array_key_exists($name, $this->data)){
                return $this->data[$name];
            }
            
        }
        
        // chiamato quando si invocano le funzioni isset() su un campo non accessibili
        public function __isset($name){
            return isset($this->data[$name]);
        }
        
        // chiamato quando si invoca la funzione unset() su un campo non accessibile
        public function __unset($name){
            unset($this->data[$name]);
        }
        
    }
    
    $person = new Person;
    $person->name = 'Mario Rossi';
    echo $person->name; // Sto creando la proprietà name con valore Mario Rossi
```  

### Metodi
L'*overloading* dei metodi avviene mediante l'utilizzo di due metodi magici: **__call()** e **__callStatic()**.

```php
    class Test {
        
        /**
         * Chiamato quando si cerca di effettuare un'invocazione 
         * ad un metodo che non esiste o un metodo privato
         */
        public function __call($name, $values){
            echo "Sto invocando il metodo ".$name." con parametri ".implode(', ', $values)."\n";
        }
        
        /**
         * Chiamato quando si cerca di effettuare un'invocazione 
         * ad un metodo inaccessibile in un contesto statico
         */
        public static function __callStatic($name, $values){
            echo "Sto invocando il metodo statico ".$name." con parametri ".implode(', ', $values)."\n";
        }
        
    }
    
    $test = new Test;
    $test->testCall('Test'); // Sto invocando il metodo testCall con parametri Test.
    Test::testCallStatic('Test'); // Sto invocando il metodo testCallStatic con parametri Test.
```  

## Clonazione
Per clonare un oggetto è sufficiente impiegare la parola chiave *clone* dopo l'operatore di assegnazione =. Questa funzione nativa crea automaticamente una nuova istanza dell'oggetto con le relative copie delle proprietà; si tratta di una copia precisa e indipendente dell'altro oggetto, dove eventuali aggiunte o modifiche al clone non incideranno sull'originale.

```php
    // nuovo oggetto Person
    $personA = new Person();
    $personA->name = "Mario";
    $personA->surname = "Rossi";
 
    // clonazione
    $personB = clone $personA;
    $personB->surname = "Bianchi";
  
    var_dump($personA);
    var_dump($personB);
```
L'output generato sarà il seguente:
```
    object(Person)#1 (2) {
        ["name"] => string(5) "Mario"
        ["surname"] => string(5) "Rossi"
    }
    
    object(Person)#2 (2) {
        ["name"] => string(5) "Mario"
        ["surname"] => string(7) "Bianchi"
    }

```

### __clone()
Il metodo *__clone* fornisce tutte le funzionalità per la clonazione completa e indipendente di un oggetto, esso crea un nuovo oggetto identico all'originale copiando tutte le variabili membro.

```php
    class Person {
        
        public $name;
        public $surname;
        public $active;
        
        public function __clone(){
            $this->active = 1;
        }
    }
    
    $personA = new Person;
    $personA->name = 'Mario';
    $personA->suername = 'Rossi';
    $personA->active = 2;
    
    $personB = clone $personA;
    
    var_dump($personA);
    var_dump($personB);
```
L'output generato sarà il seguente:
```
    object(Person)#1 (2) {
        ["name"] => string(5) "Mario"
        ["surname"] => string(5) "Rossi"
        ["active"] => int(1) 2
    }
    
    object(Person)#2 (2) {
        ["name"] => string(5) "Mario"
        ["surname"] => string(5) "Rossi"
        ["active"] => int(1) 1
    }

```

## Type Hinting
Il Type Hinting (o "suggerimento del tipo") è una tecnica che ci permette di specificare il tipo di oggetto passato, come parametro in una dichiarazione di funzione o di un metodo, facendo precedere il namespace dello stesso dal nome della classe desiderata. In PHP, i tipi scalari, come stringhe e valori interi non sono supportati dal Type Hinting.

```php
    class Person {
        
        public $name;
        
        public function __construct($name){
            $this->name = $name;
        }
    }
    
    // la funzione contiene il type hinting Person
    function infoPerson(Person $person){
        return $person->name;
    }
    
    $person = new Person('Mario Rossi');
    $name = infoPerson($person);
    echo $name; // Mario Rossi
```

## Metodi magici

## Iterazione
L'iterazione consente di rendere un oggetto compatibile con il costrutto *foreach* come se si trattasse di un array mantenendo però l'essenza di oggetto che può integrare la propria logica business.

```php
    class MyClass {
    
        public $var1         = 'value 1';
        public $var2         = 'value 2';
        public $var3         = 'value 3';
        protected $protected = 'protected var';
        private $private     = 'private var';

        function iterateVisible() {

           foreach ($this as $key => $value) {
               print "$key => $value\n";
           }

        }
        
    }

    $class = new MyClass();
    $class->iterateVisible();    
```
L'output generato sarà il seguente:
```
    var1 => value 1
    var2 => value 2
    var3 => value 3
    protected => protected var
    private => private var
```

### Iterator
Per avere un controllo maggiore sull'iterazione è possibile implementare l'interfaccia *Iterator* aggiungendo 5 metodi (tutti public e senza parametri) alla nostra classe. Ciò consente all'oggetto di definire come sarà iterato e quali valori potranno essere disponibili ad ogni iterazione.

```php
    class MyIterator implements Iterator {
    
        private $var = array();

        public function __construct($array){

            if (is_array($array)) {
                $this->var = $array;
            }

        }

        // Sposta il cursore alla posizione iniziale e non restituisce niente.
        public function rewind(){

            echo "rewinding\n";
            reset($this->var);

        }

        // Restituisce l'oggetto alla posizione attuale del cursore.
        public function current(){

            $var = current($this->var);
            echo "current: $var\n";
            return $var;

        }

        // Restituisce l'indice attuale del cursore (cioè la variabile menzionata precedentemente).
        public function key(){

            $var = key($this->var);
            echo "key: $var\n";
            return $var;

        }

        // Sposta il cursore alla posizione successiva e non restituisce niente.
        public function next(){
        
            $var = next($this->var);
            echo "next: $var\n";
            return $var;
        
        }
        
        /**
         * Restituisce un valore booleano true se la posizione attuale 
         * del cursore corrisponde ad un oggetto, altrimenti false. 
         * Nel caso in cui venga restituito false il ciclo viene terminato.
         */
        public function valid(){
        
            $key = key($this->var);
            $var = ($key !== NULL && $key !== FALSE);
            echo "valid: $var\n";
            return $var;
        
        }

    }

    $values = array(1,2,3);
    $iterator = new MyIterator($values);

    foreach ($iterator as $key => $value) {
        print "$key: $value\n";
    }
```
L'output generato sarà il seguente:
```
    rewinding
    valid: 1
    current: 1
    key: 0
    0: 1
    
    next: 2
    valid: 1
    current: 2
    key: 1
    1: 2
    
    next: 3
    valid: 1
    current: 3
    key: 2
    2: 3
    
    next:
    valid:
```
Durante un ciclo *foreach* viene richiamato il metodo *rewind()* portando il cursore alla posizione iniziale, quindi viene chiamato il metodo *valid()* per controllare se la posizione attuale è disponibile, in caso positivo vengono chiamati i metodi *key()* e *current()* per ottenere l'indice e il valore attuali. A questo punto viene chiamato il metodo *next()* e il ciclo ricomincia dal metodo *valid()* fino a che non si ottiene un valore *false*.

### IteratorAggregate
Per facilitare il tutto, è possibile implementare l'interfaccia *IteratorAggregate* la quale espone un singolo metodo, *getIterator()*, da richiamare senza parametri. Quindi l'esempio precedente si semplifica così:
```php
    class MyCollection implements IteratorAggregate {
        
        private $items = array();
        private $count = 0;

        // Metodo obbligatorio
        public function getIterator() {
            return new MyIterator($this->items);
        }

        public function add($value) {
            $this->items[$this->count++] = $value;
        }
        
    }

    $coll = new MyCollection();
    $coll->add('value 1');
    $coll->add('value 2');
    $coll->add('value 3');

    foreach ($coll as $key => $val){
        echo "key/value: [$key -> $val]\n\n";
    }
```
L'output generato sarà il seguente:
```
    rewinding
    current: value 1
    valid: 1
    current: value 1
    key: 0
    key/value: [0 -> value 1]

    next: value 2
    current: value 2
    valid: 1
    current: value 2
    key: 1
    key/value: [1 -> value 2]

    next: value 3
    current: value 3
    valid: 1
    current: value 3
    key: 2
    key/value: [2 -> value 3]

    next:
    current:
    valid:
```
## Classi anonime
Le classi anonime possono essere istanziate più di una volta tramite il costrutto *new*. Inoltre non possono essere estese da altre classi comportandosi essenzialmente come delle classi *final*. Per il resto possiedono tutte le caratteristiche di una classe comune.

```php
    $student = new class('Mario Rossi'){
        
        public $name;
        
        public function __construct($name){
            $this->name = $name
        }
        
        public function getName(){
            return $this->name;
        }
        
    }
    
    echo $student->getName(); // Mario Rossi  
```
