<?php

namespace AlecRabbit\Tests\Accessories;


use function AlecRabbit\format_bytes;
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
        $this->assertEquals(format_bytes(memory_get_usage(true)), MemoryUsage::get(true));
        $this->assertEquals(format_bytes(memory_get_peak_usage()), MemoryUsage::getPeak());
    }
}