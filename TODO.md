- [x] move rewindable range() function to Rewindable class
```php
$r = Rewindable::range(1,3);
```
- [ ] add Caller class 
- [ ] Circular can use generator or Rewindable as parameter 
```php
$c = new Circular(Rewindable::range(1,3));
```