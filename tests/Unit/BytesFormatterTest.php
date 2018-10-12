<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */

use AlecRabbit\BytesFormatter;
use PHPUnit\Framework\TestCase;

class BytesFormatterTest extends TestCase
{
    /** @test */
    public function ProcessParametersCorrectly(): void
    {
        $this->assertEquals('1.00KB', BytesFormatter::format(1024, null, 2));
        $this->assertEquals('1.000KB', BytesFormatter::format(1024, null, 3));
        $this->assertEquals('1.000KB', BytesFormatter::format(1024, 1, 3));
        $this->expectException('TypeError');
        $this->assertEquals('1.000KB', BytesFormatter::format(1024, null, 'sdsd'));
        $this->assertEquals('1.000KB', BytesFormatter::format(1024, [], 'sdsd'));
    }

    /** @test */
    public function ProcessFormattingCorrectly(): void
    {
        $this->assertEquals('1.00KB', BytesFormatter::format(1024 ** 1));
        $this->assertEquals('1.00MB', BytesFormatter::format(1024 ** 2));
        $this->assertEquals('1.00GB', BytesFormatter::format(1024 ** 3));
        $this->assertEquals('1.00TB', BytesFormatter::format(1024 ** 4));
        $this->assertEquals('1.00PB', BytesFormatter::format(1024 ** 5));
    }

    /** @test */
    public function ProcessBytesFormattingCorrectly(): void
    {
        $this->assertEquals('1024B', BytesFormatter::format(1024 ** 1,'b'));
        $this->assertEquals('1048576B', BytesFormatter::format(1024 ** 2,'b'));
        $this->assertEquals('23535235B', BytesFormatter::format(23535235,'b'));
    }

    /** @test */
    public function CalculatesKilobytesCorrectly(): void
    {
        // 1.010742188  = 1035 Bytes
        $this->assertEquals('1.0KB', BytesFormatter::format(1035, 'KB', 1));
        $this->assertEquals('1.01KB', BytesFormatter::format(1035, 'KB', 2));
        $this->assertEquals('1.011KB', BytesFormatter::format(1035, 'KB', 3));
        $this->assertEquals('1.0107KB', BytesFormatter::format(1035, 'KB', 4));
        $this->assertEquals('1.01074KB', BytesFormatter::format(1035, 'KB', 5));
    }

    /** @test */
    public function CalculatesMegabytesCorrectly(): void
    {
        // 1058.803092957  = 1110235512 Bytes
        $this->assertEquals('1058.8MB', BytesFormatter::format(1110235512, 'MB', 1));
        $this->assertEquals('1058.80MB', BytesFormatter::format(1110235512, 'MB', 2));
        $this->assertEquals('1058.803MB', BytesFormatter::format(1110235512, 'MB', 3));
        $this->assertEquals('1058.8031MB', BytesFormatter::format(1110235512, 'MB', 4));
        $this->assertEquals('1058.80309MB', BytesFormatter::format(1110235512, 'MB', 5));
        $this->assertEquals('1058.803093MB', BytesFormatter::format(1110235512, 'MB', 6));
        $this->assertEquals('1058.8030930MB', BytesFormatter::format(1110235512, 'MB', 7));
        $this->assertEquals('1058.80309296MB', BytesFormatter::format(1110235512, 'MB', 8));
        $this->assertEquals('1058.803092957MB', BytesFormatter::format(1110235512, 'MB', 9));
    }

    /** @test */
    public function ProcessesLowercaseCorrectly(): void
    {
        // 1058.803092957  = 1110235512 Bytes
        $this->assertEquals('1058.8MB', BytesFormatter::format(1110235512, 'mB', 1));
        $this->assertEquals('1058.80MB', BytesFormatter::format(1110235512, 'Mb', 2));
        $this->assertEquals('1084214.37KB', BytesFormatter::format(1110235512, 'kb', 2));
    }

    /** @test */
    public function ProcessNegativeCorrectly(): void
    {
        $this->assertEquals('-1024B', BytesFormatter::format(-1024, 'B'));
        $this->assertEquals('-1.00KB', BytesFormatter::format(-1024));
        $this->assertEquals('-1.18MB', BytesFormatter::format(-1234024));
    }

    /** @test */
    public function ProcessFloatCorrectly(): void
    {
        $this->assertEquals('1B', BytesFormatter::format(1.9));
        $this->assertEquals('0B', BytesFormatter::format(0.3));
    }

    /** @test */
    public function ProcessBigNumbersCorrectly(): void
    {
        $this->assertEquals('1.999999999068677425384521GB', BytesFormatter::format(2147483647, null, 24));
        if (PHP_INT_MAX > 2147483647) {
            $this->assertEquals('3.862645148299634456634521GB', BytesFormatter::format(4147483647, null, 24));
            $this->assertEquals('8.000000000000000000000000EB', BytesFormatter::format(9223372036854775807, null, 24));
            $this->expectException('TypeError');
            $this->assertEquals('8.000000000000000000000000EB', BytesFormatter::format(9323372036854775807, null, 24));
        } else {
            $this->expectException('TypeError');
            $this->assertEquals('3.862645148299634456634521GB', BytesFormatter::format(4147483647, null, 24));
        }
    }

}