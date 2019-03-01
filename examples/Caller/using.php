<?php declare(strict_types=1);

use AlecRabbit\Accessories\Caller;
use function AlecRabbit\typeOf;

require_once __DIR__ . '/../../vendor/autoload.php';

$c = new DoingSomething();
try {
    $c->doSomething();
} catch (\Exception $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
echo PHP_EOL;

try {
    $c->doSomethingElse();
} catch (\Exception $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
echo PHP_EOL;

// Output:

// doing something
// Param 1 for OneBase::__constructor should be type of "int", "string" given.
// [101:"/var/www/examples/Caller/using.php"] DoingSomething->oneBase()
//
// doing something else
// Param 1 for TwoBase::__constructor should be type of "int", "string" given.
// [114:"/var/www/examples/Caller/using.php"] DoingSomething->twoBase()

abstract class AbstractBase
{

    /**
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        $this->assertOptions($options);
    }

    /**
     * @param mixed $options
     */
    protected function assertOptions($options): void
    {
        if (null !== $options && !is_int($options)) {
            throw new \RuntimeException(
                'Param 1 for ' . static::class . '::__constructor should be type of "int", "' .
                typeOf($options) . '" given.' . PHP_EOL .
                'Caller: ' . Caller::get(3)
            );
        }
    }
}


class OneBase extends AbstractBase
{

    public function __construct($options = null)
    {
        parent::__construct($options);
        // some specific operations
    }
}

class TwoBase extends AbstractBase
{

    public function __construct($options = null)
    {
        parent::__construct($options);
        // some specific operations
    }
}

class DoingSomething
{
    public function doSomething(): void
    {
        echo 'doing something' . PHP_EOL;
        $this->oneBase('');
    }

    private function oneBase($options): void
    {
        // this will throw
        new OneBase($options);
    }

    public function doSomethingElse(): void
    {
        echo 'doing something else' . PHP_EOL;
        self::twoBase('');
    }

    private static function twoBase($options): void
    {
        // this will throw
        new TwoBase($options);
    }
}


