- [x] Let's not confuse base logic with utility functions, move range() function to R class (0.3.0)
```php
$r = R::range(1,3);
```
- [x] move rewindable range() function to Rewindable class (0.3.0-BETA)
```php
$r = Rewindable::range(1,3);
```
- [x] add Caller class (0.3.0-BETA)
- [x] Move all classes to \AlecRabbit\Accessories namespace (0.3.0-BETA) 
- [ ] Circular can use generator or Rewindable as parameter 
```php
$c = new Circular(Rewindable::range(1,3));
```