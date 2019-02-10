<?php

namespace AlecRabbit\Tests\Accessories;


use AlecRabbit\G;
use PHPUnit\Framework\TestCase;

class GTest extends TestCase
{

    /**
     * @test
     * @dataProvider rangeDataProvider
     * @param $expected
     * @param $start
     * @param $stop
     * @param $step
     */
    public function range($expected, $start, $stop, $step): void
    {
        $result = [];
        foreach (G::range($start, $stop, $step) as $value) {
            $result[] = $value;
        }
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @dataProvider rangeDataProviderWithException
     * @param $start
     * @param $stop
     * @param $step
     */
    public function rangeWithException($start, $stop, $step): void
    {
        $this->expectException(\LogicException::class);
        iterator_to_array(G::range($start, $stop, $step));
    }

    public function rangeDataProvider(): array
    {
        return [
            // [$expected, $start, $stop, $step],
            [[1, 1.4, 1.8], 1, 2, 0.4],
            [[2, 1.6, 1.2], 2, 1, 0.4],
            [[1, 2, 3, 4, 5], 1, 5, 1],
            [[5, 4, 3, 2, 1], 5, 1, 1],
            [[-2, -1, 0, 1, 2], -2, 2, 1],
            [[-3, -1, 1,], -3, 2, 2],
            [[1,], 1, 1, 2],
            [[1,], 1, 1, 1],
            [[-1,], -1, -1, 1],
            [[-1,], -1, -1, 2],
        ];
    }

    public function rangeDataProviderWithException(): array
    {
        return [
            // [$expected, $start, $stop, $step],
            [1, 5, 0],
            [1, 5, -1],
        ];
    }
}