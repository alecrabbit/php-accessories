- [x] move rewindable range() function to Rewindable class (0.3.0)
```php
$r = Rewindable::range(1,3);
```
- [x] add Caller class (0.3.0)
- [x] Move all classes to \AlecRabbit\Accessories namespace (0.3.0) 
- [ ] Circular can use generator or Rewindable as parameter 
```php
$c = new Circular(Rewindable::range(1,3));
```