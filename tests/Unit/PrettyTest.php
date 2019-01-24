<?php

namespace AlecRabbit\Tests\Accessories;


use AlecRabbit\Pretty;
use PHPUnit\Framework\TestCase;
use const AlecRabbit\Helpers\Constants\UNIT_MICROSECONDS;

class PrettyTest extends TestCase
{
    /**
     * @test
     * @dataProvider  dataProvider
     * @param $expected
     * @param $args
     */
    public function prettyBytes($expected, $args): void
    {
        $this->assertEquals($expected, Pretty::bytes(...$args));
    }

    public function dataProvider(): array
    {
        return [
            ['1.0KB', [1035, 'KB', 1]],
            ['1.01KB', [1035, 'KB', 2]],
            ['1.011KB', [1035, 'KB', 3]],
            ['1.0107KB', [1035, 'KB', 4]],
            ['1.01074KB', [1035, 'KB', 5]],
            ['1.01KB', [1035, 'KB']],
        ];
    }

    /**
     * @test
     * @dataProvider  dataProviderTime
     * @param $expected
     * @param $args
     */
    public function prettyTime($expected, $args): void
    {
        $this->assertEquals($expected, Pretty::time(...$args));
    }

    public function dataProviderTime(): array
    {
        return [
            ['10350μs', [0.01035, UNIT_MICROSECONDS, 1]],
            ['10.4ms', [0.01035, null, 1]],
            ['10.3ms', [0.010349, null, 1]],
            ['10.35ms', [0.01035, null, 2]],
            ['10.351ms', [0.01035123, null, 3]],
            ['10.3532ms', [0.01035321, null, 4]],
            ['10.35123ms', [0.01035123, null, 5]],
            ['0ns', [0.00000000001]],
            ['0.1ns', [0.0000000001]],
            ['1.1ns', [0.0000000011]],
            ['342ns', [0.000000342]],
            ['1.1μs', [0.000001123]],
            ['112.3μs', [0.0001123]],
            ['1.1ms', [0.001123]],
            ['10.4ms', [0.01035123]],
            ['1s', [1.01035123]],
            ['10.1s', [10.1035123]],
            ['26.02m', [1561]],
            ['53.33m', [3200]],
            ['8983.984h', [32342342]],
        ];
    }
}