<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller;
use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\Contracts\CallerDataInterface;
use PHPUnit\Framework\TestCase;

class CallerTest extends TestCase
{
    /** @test */
    public function caller(): void
    {
        $f = function () {
            return outsideCalled();
        };
        $this->assertInstanceOf(CallerData::class, $this->called());
        $this->assertInstanceOf(CallerData::class, $f());
        $this->assertInstanceOf(CallerData::class, outsideCaller());
        $this->assertIsString((string)$this->called());
        $this->assertIsString((string)outsideCaller());
        $this->assertIsString((string)$f());
        dump((string)$this->called());
        dump((string)outsideCaller());
        dump((string)$f());
        dump($this->called()->getObject());
        dump(outsideCaller()->getObject());
        dump($f()->getObject());
    }

    public function called(): CallerDataInterface
    {
        return Caller::get();
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
