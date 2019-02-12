- [x] move range() function to R class (0.3.0-BETA)
```php
$r = R::range(1,3);
```
- [x] add Caller class (0.3.0-BETA)
- [x] Move all classes to \AlecRabbit\Accessories namespace (0.3.0-BETA) 
- [x] Add Pretty::milliseconds() (0.3.1-BETA)
- [x] Add Pretty::microseconds() alias (0.3.1-BETA)
- [x] Add Circular->value() alias for getElement() (0.3.1-BETA)
- [x] Deprecate Circular->getElement() (0.3.1-BETA)
- [ ] Circular can use generator or Rewindable as parameter 
```php
$c = new Circular(Rewindable::range(1,3));
```