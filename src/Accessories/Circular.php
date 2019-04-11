<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use function AlecRabbit\typeOf;
use Countable;

/**
 * Class Circular
 */
class Circular implements \Iterator
{
    /** @var Rewindable */
    protected $data;

    /** @var bool */
    protected $oneElement = false;

    /**
     * Circular constructor.
     * @param array|callable|Rewindable $data accepts array, callable which returns \Generator or Rewindable
     */
    public function __construct($data)
    {
        $this->data = $this->refineData($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function refineData($data)
    {
        if (\is_array($data) || $data instanceof Countable) {
            if (1 === $count = count($data)) {
                return $this->setOneElementData(reset($data));
            }
            if (0 === $count) {
                return $this->setOneElementData(null);
            }
        }
        return $this->convert($data);
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    protected function setOneElementData($data)
    {
        $this->oneElement = true;
        return $data;
    }

    /**
     * @param mixed $arg
     * @return Rewindable
     */
    private function convert(&$arg): Rewindable
    {
        if (\is_array($arg)) {
            return
                new Rewindable(
                    static function () use (&$arg): \Generator {
                        yield from $arg;
                    }
                );
        }
        if (\is_callable($arg)) {
            return
                new Rewindable($arg);
        }
        if ($arg instanceof Rewindable) {
            return $arg;
        }
        throw new \InvalidArgumentException('Unexpected argument type: ' . typeOf($arg) . ' for ' . Caller::get());
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->value();
    }

    /**
     * @return mixed
     */
    public function value()
    {
        if ($this->oneElement) {
            return $this->data;
        }
        if (null === $value = $this->current()) {
            $this->rewind();
            $value = $this->current();
        }
        $this->next();
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->data->current();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(): void
    {
        $this->data->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function next(): void
    {
        $this->data->next();
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return
            $this->data->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->data->key();
    }
}
