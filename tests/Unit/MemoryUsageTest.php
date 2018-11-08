<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */

namespace Tests;


use AlecRabbit\MemoryUsage;
use PHPUnit\Framework\TestCase;

class MemoryUsageTest extends TestCase
{
    // todo make a mocker for tests :P
    // these tests just for lulz
    /** @test */
    public function ItBehaves(): void
    {
        $this->assertEquals(format_bytes(memory_get_usage(), 'GB'), MemoryUsage::get(false, 'GB'));
        $this->assertEquals(format_bytes(memory_get_peak_usage()), MemoryUsage::getPeak());
    }
    
    /** @test */
    public function ItBehavesWithFunction(): void
    {
        $this->assertEquals(format_bytes(memory_get_usage()), MemoryUsage::get());
        $this->assertEquals(format_bytes(memory_get_peak_usage()), MemoryUsage::getPeak());
    }
}