<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */

use AlecRabbit\BytesFormatter;
use AlecRabbit\MemoryUsage;
use PHPUnit\Framework\TestCase;

class MemoryUsageTest extends TestCase
{
    /** @test */
    public function ItBehaves(): void
    {
        $this->assertEquals(BytesFormatter::format(memory_get_usage()), MemoryUsage::get());
        $this->assertEquals(BytesFormatter::format(memory_get_peak_usage()), MemoryUsage::getPeak());
    }
}