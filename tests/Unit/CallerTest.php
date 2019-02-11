<?php

declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller;
use PHPUnit\Framework\TestCase;

class CallerTest extends TestCase
{
    /** @test */
    public function caller(): void
    {
//        dump(__CLASS__, __FUNCTION__, __METHOD__);
//        dump($this->called());
        $this->assertEquals(__CLASS__ . '->' . __FUNCTION__ . '()', $this->called());
        $this->assertEquals(__NAMESPACE__ . '\outsideCaller()', outsideCaller());
    }

    public function called(): string
    {
        return Caller::get();
    }
}

function outsideCaller(): string
{
    return outsideCalled();
}

function outsideCalled(): string
{
    return Caller::get();
}