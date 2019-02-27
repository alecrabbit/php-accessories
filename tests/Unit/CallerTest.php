<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller;
use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\CallerDataFormatter;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataInterface;
use PHPUnit\Framework\TestCase;

class CallerTest extends TestCase
{
    /** @test */
    public function setFormatter(): void
    {
        $this->assertInstanceOf(CallerDataFormatter::class, Caller::getFormatter());
        $formatter = new CallerDataFormatter();
        Caller::setFormatter($formatter);
        $this->assertSame($formatter, Caller::getFormatter());
    }

    /** @test */
    public function setLimit(): void
    {
        Caller::setLimit(10);
        $this->assertSame(10, Caller::getLimit());
        Caller::setLimit(0);
    }

    /** @test */
    public function setOptions(): void
    {
        Caller::setOptions(DEBUG_BACKTRACE_PROVIDE_OBJECT);
        $this->assertSame(DEBUG_BACKTRACE_PROVIDE_OBJECT, Caller::getOptions());
        Caller::setOptions(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS);
    }

    /** @test */
    public function checkCaller(): void
    {
        $caller = $this->caller();
        $this->assertInstanceOf(CallerData::class, $caller);
        $this->assertIsString((string)$caller);
        $this->assertInstanceOf(__CLASS__, $caller->getObject());
        $this->assertNull($caller->getArgs());
    }

    public function caller(): CallerDataInterface
    {
        return Caller::get();
    }

    /** @test */
    public function checkClosure(): void
    {
        $f = function () {
            return outsideCalled();
        };
        $this->assertInstanceOf(CallerData::class, $f());
        $this->assertIsString((string)$f());
        $this->assertInstanceOf(__CLASS__, $f()->getObject());
        $this->assertNull($f()->getArgs());
    }

    /** @test */
    public function checkOutside(): void
    {
        $this->assertInstanceOf(CallerData::class, outsideCaller());
        $this->assertIsString((string)outsideCaller());
        $this->assertNull(outsideCaller()->getObject());
        $this->assertNull(outsideCaller()->getArgs());
    }
}

function outsideCaller(): CallerDataInterface
{
    return outsideCalled();
}

function outsideCalled(): CallerDataInterface
{
    return Caller::get();
}
