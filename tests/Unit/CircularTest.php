<?php

namespace AlecRabbit\Tests\Accessories;


use AlecRabbit\Accessories\Circular;
use AlecRabbit\Accessories\Rewindable;
use PHPUnit\Framework\TestCase;

class CircularTest extends TestCase
{
    /** @test */
    public function iteratesByMethodValue(): void
    {
        $c = new Circular([1, 2, 3, 4]);
        $expected = [1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2];
        $actual = [];
        for ($i = 0; $i < 18; $i++) {
            $actual[] = $c->value();
        }
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function iteratesInvoked(): void
    {
        $c = new Circular([1, 2, 3, 4]);
        $expected = [1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2];
        $actual = [];
        for ($i = 0; $i < 18; $i++) {
            $actual[] = $c();
        }
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function circularIterator(): void
    {
        $expected = [1, 2, 3, 4];
        $c = new Circular($expected);
        $actual = [];
        foreach ($c as $key => $value) {
            $actual[$key] = $value;
        }
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function circularIteratorTwo(): void
    {
        $expected = ['1' => 1, 'two' => 2, '3' => 3, 'four' => 4];
        $c = new Circular($expected);
        $actual = [];
        foreach ($c as $key => $value) {
            $actual[$key] = $value;
        }
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function acceptsGeneratorFunctionAsParameter(): void
    {
        $expected = [1 => 1, 'two' => 2, 3 => 3, 'four' => 4];
        $genFunc = function () use ($expected) {
            yield from $expected;
        };
        $c = new Circular($genFunc);
        $actual = [];
        foreach ($c as $key => $value) {
            $actual[$key] = $value;
        }
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function acceptsRewindableAsParameter(): void
    {
        $expected = [1 => 1, 'two' => 2, 3 => 3, 'four' => 4];
        $genFunc = function () use ($expected) {
            yield from $expected;
        };
        $c = new Circular(new Rewindable($genFunc));
        $actual = [];
        foreach ($c as $key => $value) {
            $actual[$key] = $value;
        }
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @dataProvider wrongArgumentsDataProvider
     * @param $args
     */
    public function throwsOnWrongArguments($args): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Circular(...$args);
    }

    public function wrongArgumentsDataProvider(): array
    {
        return [
            [
                [
                    function () {
                    },
                ],
            ],
            [[curl_init()]],
        ];
    }
}