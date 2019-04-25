<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use PHPUnit\Framework\TestCase;

class MemoryUsageReportFormatterTest extends TestCase
{
    /** @test */
    public function getFormatter(): void
    {
        $this->assertInstanceOf(MemoryUsageReportFormatter::class, MemoryUsage::getFormatter());
    }

    /** @test */
    public function wrongUnits(): void
    {
        $formatter = new MemoryUsageReportFormatter();
        $this->expectException(\RuntimeException::class);
        $formatter->setUnits('op');
    }

//    /** @test */
//    public function wrongOptions(): void
//    {
//        $this->expectException(\RuntimeException::class);
//        new MemoryUsageReportFormatter('');
//    }

    /** @test */
    public function useUnitsAndDecimals(): void
    {
        $formatter = new MemoryUsageReportFormatter();
        MemoryUsage::setFormatter($formatter);
        $formatter->setUnits('kb');
        $formatter->setDecimals(1);
        $report = new MemoryUsageReport(10000, 12345, 1024 * 64, 1024 * 128);
        $this->assertEquals('Memory: 9.8KB(12.1KB) Real: 64.0KB(128.0KB)', (string)$report);
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 9.766KB(12.056KB) Real: 64.000KB(128.000KB)', (string)$report);
        $formatter->setDecimals(5);
        $this->assertEquals('Memory: 9.766KB(12.056KB) Real: 64.000KB(128.000KB)', (string)$report);
        $formatter->setUnits('mb');
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 0.010MB(0.012MB) Real: 0.063MB(0.125MB)', (string)$report);
    }
}
