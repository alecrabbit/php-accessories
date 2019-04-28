<?php declare(strict_types=1);

namespace AlecRabbit\Accessories\Caller;

use AlecRabbit\Accessories\Caller;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataInterface;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\AbstractReport;

class CallerData extends AbstractReport implements CallerDataInterface
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

    public function __construct(
        array $caller = null
    ) {
        $caller = $caller ?? self::UNDEFINED;
        $this->function = $caller[self::FUNCTION];
        $this->parse($caller);
    }

    protected function parse(array $caller): void
    {
        $this->line = $caller[self::LINE] ?? null;
        $this->file = $caller[self::FILE] ?? null;
        $this->class = $caller[self::CLS] ?? null;
        $this->object = $caller[self::OBJECT] ?? null;
        $this->type = $caller[self::TYPE] ?? null;
        $this->args = $caller[self::ARGS] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return Caller::getFormatter()->format($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getFunction(): string
    {
        return $this->function;
    }

    /**
     * {@inheritdoc}
     */
    public function getLine(): ?int
    {
        return $this->line;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(): ?string
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function getObject(): ?object
    {
        return $this->object;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getArgs(): ?array
    {
        return $this->args;
    }

    /**
     * @param ReportableInterface $reportable
     * @return ReportInterface
     */
    public function buildOn(ReportableInterface $reportable): ReportInterface
    {
        if ($reportable instanceof Caller) {
            return $this;
        }
        throw new \InvalidArgumentException(
            Caller::class . ' expected, ' . get_class($reportable) . ' given.'
        );
    }
}
