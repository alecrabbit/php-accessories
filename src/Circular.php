<?php

declare(strict_types=1);

namespace AlecRabbit;

/**
 * Class Circular
 */
class Circular implements \Iterator
{
    /** @var array */
    protected $data;

    /**
     * Circular constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        reset($this->data);
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->getElement();
    }

    /**
     * @return mixed
     */
    public function getElement()
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
}
