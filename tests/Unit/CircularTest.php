<?php

namespace AlecRabbit\Tests\Accessories;


use AlecRabbit\Circular;
use PHPUnit\Framework\TestCase;

class CircularTest extends TestCase
{
    /** @test */
    public function iterates(): void
    {
        $c = new Circular([1, 2, 3, 4]);
        $expected = [1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2, 3, 4, 1, 2];
        $actual = [];
        for ($i = 0; $i < 18; $i++) {
            $actual[] = $c->getElement();
        }
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function invokes(): void
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
        $expected = ['1'=> 1,'two' => 2, '3' => 3, 'four' => 4];
        $c = new Circular($expected);
        $actual = [];
        foreach ($c as $key => $value) {
            $actual[$key] = $value;
        }
        $this->assertEquals($expected, $actual);
    }
}