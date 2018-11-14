<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */

namespace Tests;


use AlecRabbit\BytesFormatter;
use PHPUnit\Framework\TestCase;

class BytesFormatterTest extends TestCase
{
    /**
     * @test
     * @dataProvider  dataProvider
     * @param $expected
     * @param $bytes
     * @param $unit
     * @param $decimals
     */
    public function formatterClass($expected, $bytes, $unit, $decimals): void
    {
        $this->assertEquals($expected, BytesFormatter::format($bytes, $unit, $decimals));
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
}