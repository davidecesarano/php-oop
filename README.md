# Programmazione a oggetti con PHP
* Classi, proprietà e metodi
* Costruttore e distruttore
* Indicatori di visibilità
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

## Costruttore e Distruttore
* Il metodo *__construct* viene richiamato nella fase di creazione dell'oggetto.
* Il metodo *__destruct* viene richiamato prima che l'oggetto sia distrutto.

```php
  class Foo {
    
    public function __construct(){
      echo "Costruttore";
    }
    
    public function __destruct(){
      echo "Distruttore";
    }
    
  }
  
  $foo = new Foo;
```

## Indicatori di visibilità

### public

```php
  
```

### private

```php
  
```

### protected

```php
  
```
