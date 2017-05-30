# ```Zephir```

Niedawno odwiedziłem stronę: https://zephir-lang.com/

> PHP is one of the most popular languages in use for the development of web applications. Dynamically typed and interpreted languages like PHP offer very high productivity due to their flexibility.
  Since version 4 and then 5, PHP is based on the Zend Engine implementation. This is a virtual machine that executes the PHP code from its bytecode representation. Zend Engine is almost present in every PHP installation in the world, with Zephir, you can create extensions for PHP running under the Zend Engine.
  PHP is hosting Zephir, so they obviously have a lot of similarities, however; they have important differences that give Zephir its own personality. For example, Zephir is more strict, and it could be make you less productive compared to PHP due to the compilation step.
  
Postanowiłem sprawdzić czy rzeczywiście następuje przyspieszenie. Jednym z najczęciej wykorzystywanych funkcjonalności w sklepie internetowym jest obliczanie ceny.
W tym celu przepisałem jedną z naszych libek: https://packagist.org/packages/ayeo/price do formatu Zephira, skompilowałem i wykonałem test wydajności na prostym rachunku:

Wersja php:
```php
$price1 = new Ayeo\Price\Price::buildByNett(100 'PLN');
$price2 = new Ayeo\Price\Price::buildByNett(10, 'PLN');
$price3 = new Ayeo\Price\Price::buildByNett(20, 'PLN');
$price4 = new Ayeo\Price\Price::buildByNett(50, 'PLN');

$price1->add($price2)->subtract($price3)->add($price4)->multiply(2);
```

Wersja z przekompilowanego rozszerzenia:
```
$price1 = new \ISystems\Price\Container(100, 123, 'PLN');
$price2 = new \ISystems\Price\Container(10, 12.3, 'PLN');
$price3 = new \ISystems\Price\Container(20, 24.6, 'PLN');
$price4 = new \ISystems\Price\Container(50, 61.5, 'PLN');

$price1->add($price2)->subtract($price3)->add($price4)->multiply(2);
```

W każdej iteracji kwoty netto były losowane z przedziału od 10 do 100, działanie pozostawało te same. Poniżej wyniki:

![Performance](http://q.i-systems.pl/file/f42648bd.png "performance")

Różnica kolosalna jeśli pomnożymy to przez ilość obliczeń wykonywanej w koszyku i-sklep.