<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */

namespace Tests;


use AlecRabbit\SimpleFormatter;
use PHPUnit\Framework\TestCase;

class SimpleFormatterTest extends TestCase
{
    /**
     * @test
     * @dataProvider  dataProvider
     * @param $expected
     * @param $bytes
     * @param $unit
     * @param $decimals
     */
    public function formatterBytes($expected, $bytes, $unit, $decimals): void
    {
        $this->assertEquals($expected, SimpleFormatter::bytes($bytes, $unit, $decimals));
    }

    public function dataProvider(): array
    {
        return [
            ['1.0KB', 1035, 'KB', 1],
            ['1.01KB', 1035, 'KB', 2],
            ['1.011KB', 1035, 'KB', 3],
            ['1.0107KB', 1035, 'KB', 4],
            ['1.01074KB', 1035, 'KB', 5],
            ['1.01KB', 1035, 'KB', null],
        ];
    }

    /**
     * @test
     * @dataProvider  dataProviderTime
     * @param $expected
     * @param $value
     * @param $unit
     * @param $decimals
     */
    public function formatterTime($expected, $value, $unit, $decimals): void
    {
        $this->assertEquals($expected, SimpleFormatter::time($value, $unit, $decimals));
    }

    public function dataProviderTime(): array
    {
        return [
            ['10350μs', 0.01035, UNIT_MICROSECONDS, 1],
            ['10.4ms', 0.01035, null, 1],
            ['10.3ms', 0.010349, null, 1],
            ['10.35ms', 0.01035, null, 2],
            ['10.351ms', 0.01035123, null, 3],
            ['10.3532ms', 0.01035321, null, 4],
            ['10.35123ms', 0.01035123, null, 5],
        ];
    }
}