<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use function AlecRabbit\typeOf;

/**
 * Class Circular
 */
class Circular implements \Iterator
{
    /** @var mixed */
    protected $data;

    /**
     * Circular constructor.
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $this->assertData($data);
        dump()
        reset($this->data);
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->value();
    }

    /**
     * @deprecated
     * @return mixed
     */
    public function getElement()
    {
        return $this->value();
    }

    /**
     * @return mixed
     */
    public function value()
    {
        if (false === $result = current($this->data)) {
            $result = reset($this->data);
        }
        next($this->data);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function next(): void
    {
        next($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return
            false !== current($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind(): void
    {
        reset($this->data);
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    private function assertData($data)
    {
        if (is_array($data)) {
            return $data;
        }
        if (is_callable($data)) {
            if (!($data() instanceof \Generator)) {
                throw new \InvalidArgumentException('Return type of your generator function MUST be a \Generator.');
            }
            return new Rewindable($data);
        }
        throw new \InvalidArgumentException('Unexpected argument type: ' . typeOf($data) . ' for ' . Caller::get());
    }
}
