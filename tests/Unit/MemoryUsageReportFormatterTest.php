<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use AlecRabbit\Reports\Core\AbstractReport;
use PHPUnit\Framework\TestCase;

class MemoryUsageReportFormatterTest extends TestCase
{
    /** @test */
    public function getFormatter(): void
    {
        $this->assertInstanceOf(MemoryUsageReportFormatter::class, (new MemoryUsage)->report()->getFormatter());
    }

    /** @test */
    public function wrongUnits(): void
    {
        $formatter = new MemoryUsageReportFormatter();
        $this->expectException(\RuntimeException::class);
        $formatter->setUnits('op');
    }

    /** @test */
    public function wrongDecimals(): void
    {
        $formatter = new MemoryUsageReportFormatter();
        $this->expectException(\TypeError::class);
        $formatter->setDecimals('op');
    }

    /** @test */
    public function wrongOptions(): void
    {
        $this->expectException(\TypeError::class);
        new MemoryUsageReportFormatter('');
    }

    /** @test */
    public function useUnitsAndDecimals(): void
    {
        $mu = new MemoryUsage();
        $formatter = new MemoryUsageReportFormatter();
        $mu->setFormatter($formatter);
        $formatter->setUnits('kb');
        $formatter->setDecimals(1);
        $report = new MemoryUsageReport(
            10000,
            12345,
            1024 * 64,
            1024 * 128,
            $formatter,
            $mu
        );
        $this->assertEquals('Memory: 9.8KB(12.1KB) Real: 64.0KB(128.0KB)', (string)$report);
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 9.766KB(12.056KB) Real: 64.000KB(128.000KB)', (string)$report);
        $formatter->setDecimals(5);
        $this->assertEquals('Memory: 9.766KB(12.056KB) Real: 64.000KB(128.000KB)', (string)$report);
        $formatter->setUnits('mb');
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 0.010MB(0.012MB) Real: 0.063MB(0.125MB)', (string)$report);
    }

    /** @test */
    public function wrongInstance(): void
    {
        $mu = new MemoryUsage();
        $formatter = new MemoryUsageReportFormatter();
        $mu->setFormatter($formatter);
        $str = $formatter->format(
            new class extends AbstractReport
            {
            }
        );
        $this->assertStringContainsString(MemoryUsageReport::class, $str);
        $this->assertStringContainsString('expected', $str);
        $this->assertStringContainsString(__FILE__, $str);
        $this->assertStringContainsString('given', $str);
    }
}
