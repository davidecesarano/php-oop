# Programmazione a oggetti con PHP
* Basi
  * Creare una classe
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

## Le basi

* **Proprietà**. Variabile di una classe.
* **Metodo**. Funzione di una classe.
* **Oggetto**. Instanza di una classe.

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
  echo $persona->getName();
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
  namespace Europe
  class Italy {
    //...
  }
  
  echo Italy::class; // Europe\Italy;
```

## Costruttore e Distruttore

```php
  class Foo {
    
    // costruttore: richiamato nella fase di creazione dell'oggetto
    public function __construct(){
      echo "Costruttore";
    }
    
    // distruttore: richiamato prima che l'oggetto sia distrutto
    public function __destruct(){
      echo "Distruttore";
    }
    
  }
  
  $foo = new Foo;
```

## Indicatori di visibilità

### public
Sono accessibili sia dall'interno che dall'esterno della classe e dalle classi derivate da essa.
```php
  class Person {
    
    public $name;
    
    public function __construct($name){
      $this->name = $name;
    }
    
  }
  
  $persona = new Person('Mario Rossi');
  echo $persona->name;
```  

### private
Possono essere utilizzati soltanto all'interno della classe stessa.
```php

``` 

### protected
Possono essere utilizzati all'interno della classe stessa e all'interno delle classi derivate, ma non sono accessibili dall'esterno della classe.
```php
  
```
