<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportInterface;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\format_bytes;

class MemoryUsageReportTest extends TestCase
{
    /** @test */
    public function instance(): void
    {
        $formatter = new MemoryUsageReportFormatter();
        $report = new MemoryUsageReport(100000,200000, 150000, 210000, $formatter);
        $this->assertEquals('Memory: 0.10MB(0.14MB) Peak: 0.19MB(0.20MB)', (string)$report);
        $this->assertEquals(100000, $report->getUsage());
        $this->assertEquals(200000, $report->getPeakUsage());
        $this->assertEquals(150000, $report->getUsageReal());
        $this->assertEquals(210000, $report->getPeakUsageReal());
        $this->assertEquals(100000, $report->getUsageDiff());
        $this->assertEquals(200000, $report->getPeakUsageDiff());
        $this->assertEquals(150000, $report->getUsageRealDiff());
        $this->assertEquals(210000, $report->getPeakUsageRealDiff());
        $report2 = new MemoryUsageReport(110000,220000, 151500, 212100, $formatter);
        $this->assertEquals('Memory: 0.10MB(0.14MB) Peak: 0.21MB(0.20MB)', (string)$report2);
        $report2 = $report2->diff($report);
        $this->assertEquals(110000, $report2->getUsage());
        $this->assertEquals(220000, $report2->getPeakUsage());
        $this->assertEquals(151500, $report2->getUsageReal());
        $this->assertEquals(212100, $report2->getPeakUsageReal());
        $this->assertEquals(10000, $report2->getUsageDiff());
        $this->assertEquals(20000, $report2->getPeakUsageDiff());
        $this->assertEquals(1500, $report2->getUsageRealDiff());
        $this->assertEquals(2100, $report2->getPeakUsageRealDiff());
    }
}
