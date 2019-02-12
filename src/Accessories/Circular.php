<?php

declare(strict_types=1);

namespace AlecRabbit\Accessories;

use function AlecRabbit\typeOf;

/**
 * Class Circular
 */
class Circular implements \Iterator
{
    /** @var Rewindable */
    protected $data;

    /**
     * Circular constructor.
     * @param array|callable|Rewindable $data
     */
    public function __construct($data)
    {
        $this->data = $this->convert($data);
    }

    /**
     * @param mixed $data
     * @return Rewindable
     */
    private function convert(&$data): Rewindable
    {
        if (\is_array($data)) {
            return
                new Rewindable(
                    function () use (&$data): \Generator {
                        yield from $data;
                    }
                );
        }
        if (\is_callable($data)) {
            return
                new Rewindable($data);
        }
        if ($data instanceof Rewindable) {
            return $data;
        }
        throw new \InvalidArgumentException('Unexpected argument type: ' . typeOf($data) . ' for ' . Caller::get());
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
        if (null === $value = $this->current()) {
            $this->rewind();
            $value = $this->current();
        }
        $this->next();
        return $value;
//        if (!$this->valid()) {
//            $this->rewind();
//        } else {
//            $this->next();
//        }
//        return $this->current();
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
