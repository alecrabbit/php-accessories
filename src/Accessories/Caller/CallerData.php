<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller\Contracts\CallerDataFormatterInterface;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataInterface;

class CallerData implements CallerDataInterface
{
    /** @var string */
    protected $function;

    /** @var int|null */
    protected $line;

    /** @var string|null */
    protected $file;

    /** @var string|null */
    protected $class;

    /** @var object|null */
    protected $object;

    /** @var string|null */
    protected $type;

    /** @var array|null */
    protected $args;

    /** @var CallerDataFormatterInterface */
    protected $formatter;

    /** @var array */
    protected $caller;


    public function __construct(?int $depth, ?CallerDataFormatterInterface $formatter = null)
    {
        $this->formatter = $formatter ?? new CallerDataFormatter();
        $this->caller = debug_backtrace()[$depth] ?? self::UNDEFINED;
        $this->function = $this->caller[self::FUNCTION];
        $this->parse();
    }

    public function __toString(): string
    {
        return $this->formatter->process($this);
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * @return null|int
     */
    public function getLine(): ?int
    {
        return $this->line;
    }

    /**
     * @return null|string
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * @return null|string
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return null|object
     */
    public function getObject(): ?object
    {
        return $this->object;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return null|array
     */
    public function getArgs(): ?array
    {
        return $this->args;
    }

    protected function parse(): void
    {
        $this->line = $this->caller[self::LINE] ?? null;
        $this->file = $this->caller[self::FILE] ?? null;
        $this->class = $this->caller[self::CLS] ?? null;
        $this->object = $this->caller[self::OBJECT] ?? null;
        $this->type = $this->caller[self::TYPE] ?? null;
        $this->args = $this->caller[self::ARGS] ?? null;
    }
}
