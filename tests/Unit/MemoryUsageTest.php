<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\format_bytes;

class MemoryUsageTest extends TestCase
{
    /** @test */
    public function setFormatter(): void
    {
        $formatter = new MemoryUsageReportFormatter();
        MemoryUsage::setFormatter($formatter);
        $this->assertSame($formatter, MemoryUsage::getFormatter());
    }

    /** @test */
    public function getFormatter(): void
    {
        $this->assertInstanceOf(MemoryUsageReportFormatter::class, MemoryUsage::getFormatter());
    }

    /** @test */
    public function formatGet(): void
    {
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::get(false, 'MB'));
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::getPeak(false, 'MB'));
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::get(true, 'MB'));
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::getPeak(true, 'MB'));
    }

    /** @test */
    public function intGetters(): void
    {
        $report = MemoryUsage::reportStatic();
        $this->assertIsInt($report->getUsage());
        $this->assertIsInt($report->getPeakUsage());
        $this->assertIsInt($report->getUsageReal());
        $this->assertIsInt($report->getPeakUsageReal());
    }

    /** @test */
    public function stringGetters(): void
    {
        $report = MemoryUsage::reportStatic();
        $this->assertIsString($report->getUsageString());
        $this->assertIsString($report->getPeakUsageString());
        $this->assertIsString($report->getUsageRealString());
        $this->assertIsString($report->getPeakUsageRealString());

        $this->assertStringMatchesFormat('%fMB', $report->getUsageString());
        $this->assertStringMatchesFormat('%fMB', $report->getPeakUsageString());
        $this->assertStringMatchesFormat('%fMB', $report->getUsageRealString());
        $this->assertStringMatchesFormat('%fMB', $report->getPeakUsageRealString());
    }

    /** @test */
    public function formatReport(): void
    {
        $this->assertStringMatchesFormat(
            sprintf(
                MemoryUsageReportFormatter::STRING_FORMAT,
                '%fMB',
                '%fMB',
                '%fMB',
                '%fMB'
            ),
            (string)MemoryUsage::reportStatic()
        );
    }

    // these tests just for lulz

    /** @test */
    public function itBehaves(): void
    {
        $this->assertEquals(format_bytes(memory_get_usage(), 'GB'), MemoryUsage::get(false, 'GB'));
        $this->assertEquals(format_bytes(memory_get_usage(true)), MemoryUsage::get(true));
        $this->assertEquals(format_bytes(memory_get_peak_usage()), MemoryUsage::getPeak());
        $this->assertIsString((string)MemoryUsage::reportStatic());
    }
}
