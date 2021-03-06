- [ ] Add tests for `MemoryUsageReport::class`
- [ ] Add tests for `CallerData::class`
- [x] Implement formatter for `MemoryUsageReport::class` (0.4.3)
- [x] Implement formatter for `CallerData::class` (0.4.2)
- [x] `Caller::get()` can process closure (0.4.2)

- [x] Circular can use `\Generator` or `Rewindable` as parameter (0.4.0-BETA) 
```php
$c = new Circular(Rewindable::range(1,3));
```
- [x] Remove `Circular->getElement()` (0.4.0-BETA)

- [x] Add `Pretty::milliseconds()` (0.3.1-BETA)
- [x] Add `Pretty::microseconds()` alias (0.3.1-BETA)
- [x] Add `Circular->value()` alias for `getElement()` (0.3.1-BETA)
- [x] Deprecate `Circular->getElement()` (0.3.1-BETA)


- [x] add `Caller::class` (0.3.0-BETA)
- [x] Move all classes to `\AlecRabbit\Accessories` namespace (0.3.0-BETA) 

- [x] move `range()` function to `R::class` (0.3.0-BETA)
```php
$r = R::range(1,3); // Rewindable range generator
```
