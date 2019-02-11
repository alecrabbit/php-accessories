<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\R;
use PHPUnit\Framework\TestCase;

class RTest extends TestCase
{

    /**
     * @test
     * @dataProvider rangeDataProvider
     * @param $expected
     * @param $start
     * @param $stop
     * @param $step
     */
    public function rangeRewindable($expected, $start, $stop, $step): void
    {
        $range = R::range($start, $stop, $step);
        $this->assertEquals($expected, iterator_to_array($range));
        $this->assertEquals($expected, iterator_to_array($range));
    }

    /**
     * @test
     * @dataProvider rangeDataProviderWithException
     * @param $start
     * @param $stop
     * @param $step
     */
    public function rangeRewindableWithException($start, $stop, $step): void
    {
        $this->expectException(\LogicException::class);
        iterator_to_array(R::range($start, $stop, $step));
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
