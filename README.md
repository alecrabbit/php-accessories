# PHP accessories

[![PHP Version](https://img.shields.io/packagist/php-v/alecrabbit/php-accessories.svg)](https://php.net)
[![Build Status](https://travis-ci.org/alecrabbit/php-accessories.svg?branch=master)](https://travis-ci.org/alecrabbit/php-accessories)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alecrabbit/php-accessories/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-accessories/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/alecrabbit/php-accessories/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/alecrabbit/php-accessories/?branch=master)
[![Total Downloads](https://poser.pugx.org/alecrabbit/php-accessories/downloads)](https://packagist.org/packages/alecrabbit/php-accessories)

[![Latest Stable Version](https://poser.pugx.org/alecrabbit/php-accessories/v/stable)](https://packagist.org/packages/alecrabbit/php-accessories)
[![Latest Stable Version](https://img.shields.io/packagist/v/alecrabbit/php-accessories.svg)](https://packagist.org/packages/alecrabbit/php-accessories)
[![Latest Unstable Version](https://poser.pugx.org/alecrabbit/php-accessories/v/unstable)](https://packagist.org/packages/alecrabbit/php-accessories)

[![License](https://poser.pugx.org/alecrabbit/php-accessories/license)](https://packagist.org/packages/alecrabbit/php-accessories)

### Installation
```bash
composer require alecrabbit/php-accessories
```

### Usage
for details see [examples](https://github.com/alecrabbit/php-accessories/tree/master/examples)


### Features

##### Caller::class 
Gets a caller `Class::method()` or `function()` or `Undefined`
```php
$caller = Caller::get() // object(AlecRabbit\Accessories\Caller\CallerData)
```
> Note: `CallerData::class` can be casted to string
```php
if($wrongArguments) {
 throw new \RuntimeException(Caller::get() . ' provided wrong arguments'); 
}
```
You can set your custom formatter for string casting:
```php
$formatter = new CustomFormatter($options);
Caller::setFormatter($formatter);
```
> Note: `CustomFormatter::class` should implement `CallerDataFormatterInterface`

##### Circular::class
Helper class to get values in a circle
```php
$c = new Circular([1, 2, 3]);
$value = $c(); // int(1) invoke 
$value = $c->value(); // int(2) get value by method
... 
$c(); // int(3)
...
$c(); // int(1)
```
> Note: `Circular::__construct` can accept `array`, `Rewindable` or callable which returns `\Generator` 

##### Rewindable::class
Rewindable generator helper class
```php
$r = new Rewindable($genFunc); // $genFunc is a callable and returns \Generator
iterator_to_array($r);
$r->rewind();
```

##### G::class 
Contains generator functions
```php
$r = G::range(1, 3);  // object(Generator)
```

##### R::class 
Contains rewindable generator functions
```php
$r = R::range(1, 3); // object(AlecRabbit\Accessories\Rewindable)
iterator_to_array($r);
$r->rewind();
```

##### Pretty::class 
String formatter, e.g. percent, bytes and time(seconds, microseconds, nanoseconds)
```php
Pretty::bytes(10584760, 'mb'); // string(7) "10.09MB"
Pretty::time(0.214); // string(5) "214ms"
Pretty::percent(0.214);  // string(6) "21.40%"

Pretty::seconds(0.214); // string(5) "214ms"

Pretty::milliseconds(214); // string(5) "214ms"

Pretty::useconds(3212); // string(5) "3.2ms"
Pretty::useconds(12); // string(5) "12μs"
// alias for useconds
Pretty::microseconds(12); // string(5) "12μs"

Pretty::nanoseconds(10485); // string(7) "10.5μs"
Pretty::nanoseconds(105); // string(7) "105ns"
```
> Note: time formatting methods of `Pretty::class` named by units they are accepting

##### MemoryUsage::class
Helper class to get memory usage
```php
$report = MemoryUsage::report('mb');
echo $report . PHP_EOL;
// Memory: 0.75MB(32.73MB) Real: 2.00MB(34.00MB)
```
You can set your custom formatter for string casting:
```php
$formatter = new CustomFormatter($options);
MemoryUsage::setFormatter($formatter);
```
> Note: `CustomFormatter::class` should implement `MemoryUsageReportFormatterInterface`

> Note: Parameter `$options` has no effect on `MemoryUsageReportFormatter`
