<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */

use AlecRabbit\DataFormatter;
use PHPUnit\Framework\TestCase;

class DataFormatterTest extends TestCase
{
    /** @test */
    public function ProcessFormattingCorrectly(): void
    {
        $this->assertEquals('1.00KB', DataFormatter::format(1024 ** 1));
        $this->assertEquals('1.00MB', DataFormatter::format(1024 ** 2));
        $this->assertEquals('1.00GB', DataFormatter::format(1024 ** 3));
        $this->assertEquals('1.00TB', DataFormatter::format(1024 ** 4));
        $this->assertEquals('1.00PB', DataFormatter::format(1024 ** 5));
    }

    /** @test */
    public function CalculatesKilobytesCorrectly(): void
    {
        // 1.010742188  = 1035 Bytes
        $this->assertEquals('1.0KB', DataFormatter::format(1035, 'KB', 1));
        $this->assertEquals('1.01KB', DataFormatter::format(1035, 'KB', 2));
        $this->assertEquals('1.011KB', DataFormatter::format(1035, 'KB', 3));
        $this->assertEquals('1.0107KB', DataFormatter::format(1035, 'KB', 4));
        $this->assertEquals('1.01074KB', DataFormatter::format(1035, 'KB', 5));
    }

    /** @test */
    public function CalculatesMegabytesCorrectly(): void
    {
        // 1058.803092957  = 1110235512 Bytes
        $this->assertEquals('1058.8MB', DataFormatter::format(1110235512, 'MB', 1));
        $this->assertEquals('1058.80MB', DataFormatter::format(1110235512, 'MB', 2));
        $this->assertEquals('1058.803MB', DataFormatter::format(1110235512, 'MB', 3));
        $this->assertEquals('1058.8031MB', DataFormatter::format(1110235512, 'MB', 4));
        $this->assertEquals('1058.80309MB', DataFormatter::format(1110235512, 'MB', 5));
        $this->assertEquals('1058.803093MB', DataFormatter::format(1110235512, 'MB', 6));
        $this->assertEquals('1058.8030930MB', DataFormatter::format(1110235512, 'MB', 7));
        $this->assertEquals('1058.80309296MB', DataFormatter::format(1110235512, 'MB', 8));
        $this->assertEquals('1058.803092957MB', DataFormatter::format(1110235512, 'MB', 9));
    }

    /** @test */
    public function ProcessNegativeCorrectly(): void
    {
        $this->assertEquals('-1.00KB', DataFormatter::format(-1024));
        $this->assertEquals('-1.18MB', DataFormatter::format(-1234024));
    }

    /** @test */
    public function ProcessFloatCorrectly(): void
    {
        $this->assertEquals('1.00B', DataFormatter::format(1.9));
        $this->assertEquals('0.00B', DataFormatter::format(0.3));
    }

    /** @test */
    public function ProcessBigNumbersCorrectly(): void
    {
        $this->assertEquals('1.999999999068677425384521GB', DataFormatter::format(2147483647, null, 24));
        if (PHP_INT_MAX > 2147483647) {
            $this->assertEquals('3.862645148299634456634521GB', DataFormatter::format(4147483647, null, 24));
            $this->assertEquals('8.000000000000000000000000EB', DataFormatter::format(9223372036854775807, null, 24));
            $this->expectException('TypeError');
            $this->assertEquals('8.000000000000000000000000EB', DataFormatter::format(9323372036854775807, null, 24));
        } else {
            $this->expectException('TypeError');
            $this->assertEquals('3.862645148299634456634521GB', DataFormatter::format(4147483647, null, 24));
        }
    }

}