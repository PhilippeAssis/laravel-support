#Wiidoo Laravel Support
Suporte para classes


##Fluent Inteface
Basta extender sua classe para `Wiidoo\Support\FluentInterface` que você tera uma classe usando a metodologia de "Interface fluente".
    
###Exemplo
```php
<?php 

use Wiidoo\Support\FluentInterface;

class Example extends FluentInterface
{
    public $foo;
    
    public $bar;
    
    public $active = false;
    
    private $result;
    
    public function join(){
        $this->result = $this->foo . ' ' . $this->bar;
        
        return $this;
    }
    
    public function clear(){
        $this->result = '';
                
        return $this;
    }
    
    public function result(){
        return $this->result;
    }
}
```

Com o modelo acima vamos aplicar a classe:

###Exemplo
```php
$example = new Example();
echo $example->foo('I Love')->bar('coffee.')->join()->result()

//saida: 'I love coffee.'

$join = $example->foo('I Love')->bar('coffee.')->join();
echo $join->clear()->result();

//saída ''
```

### Propriedades boleanas

Caso queira modificar uma proprieade boleana, vulgo `bool`, basta declara-la para passar `true` ou usar um prefixo de negação para declara-la como `false`, exemplo
```php
$example->active();

dump($example->active); // true;

$example->noActive();

dump($example->active); // false;
```

#### Prefixos de negação
Esses são os prefixos de negação:

**no**, **not**, **disable**

```php

/*
...
    public $active = false;
    public $published = true;
    public $alert = true;
...
*/

$example->active();// true
$example->noPublished();// false
$example->notPublished();// false
$example->disableAlert();// false
```

## Ultilidades

| Método                                            | Descrição                                                                                                                                                                                 |
| mergeConfig($name)                                | Faz um merge de suas propriedades com os valores declaros no arquivo de configuração passado no paramentro `$name`. Exemplo mergeConfig('app.locate') -> $this->locate.                   |
|---------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| validatePropertyChange($name, $protected = false) | Verifica se a propriedade é digna de alteração, por padrão toda propriedade publica pode ser modificada, se passar `$protected = true`as propriedades protegidas também retornaram `true` |