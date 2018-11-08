<?php
/**
 * User: alec
 * Date: 01.11.18
 * Time: 16:14
 */

namespace Unit;


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
}