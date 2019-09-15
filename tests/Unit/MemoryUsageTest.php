<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\MemoryUsage;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportFormatter;
use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReportInterface;
use PHPUnit\Framework\TestCase;
use function AlecRabbit\format_bytes;

class MemoryUsageTest extends TestCase
{
    /** @test */
    public function instance(): void
    {
        $mu = new MemoryUsage();
        $report = $mu->report();
        $this->assertInstanceOf(MemoryUsageReport::class, $report);
        /** @var MemoryUsageReportInterface $report */
        $this->assertIsInt($report->getUsage());
        $this->assertIsInt($report->getPeakUsage());
        $this->assertIsInt($report->getUsageReal());
        $this->assertIsInt($report->getPeakUsageReal());
        $this->assertNull($report->getUsageDiff());
        $this->assertNull($report->getPeakUsageDiff());
        $this->assertNull($report->getUsageRealDiff());
        $this->assertNull($report->getPeakUsageRealDiff());

        $this->assertIsString($report->getUsageString());
        $this->assertIsString($report->getPeakUsageString());
        $this->assertIsString($report->getUsageRealString());
        $this->assertIsString($report->getPeakUsageRealString());
        $this->assertIsString($report->getUsageDiffString());
        $this->assertIsString($report->getPeakUsageDiffString());
        $this->assertIsString($report->getUsageRealDiffString());
        $this->assertIsString($report->getPeakUsageRealDiffString());

        $this->assertStringMatchesFormat('%fMB', $report->getUsageString());
        $this->assertStringMatchesFormat('%fMB', $report->getPeakUsageString());
        $this->assertStringMatchesFormat('%fMB', $report->getUsageRealString());
        $this->assertStringMatchesFormat('%fMB', $report->getPeakUsageRealString());
        $this->assertStringMatchesFormat('%fB', $report->getUsageDiffString());
        $this->assertStringMatchesFormat('%fB', $report->getPeakUsageDiffString());
        $this->assertStringMatchesFormat('%fB', $report->getUsageRealDiffString());
        $this->assertStringMatchesFormat('%fB', $report->getPeakUsageRealDiffString());

        $this->assertStringMatchesFormat('%fKB', $report->getUsageString('kb'));
        $this->assertStringMatchesFormat('%fKB', $report->getPeakUsageString('kb'));
        $this->assertStringMatchesFormat('%fKB', $report->getUsageRealString('kb'));
        $this->assertStringMatchesFormat('%fKB', $report->getPeakUsageRealString('kb'));
        $this->assertStringMatchesFormat('%fB', $report->getUsageDiffString('kb'));
        $this->assertStringMatchesFormat('%fB', $report->getPeakUsageDiffString('kb'));
        $this->assertStringMatchesFormat('%fB', $report->getUsageRealDiffString('kb'));
        $this->assertStringMatchesFormat('%fB', $report->getPeakUsageRealDiffString('kb'));
    }


    /** @test */
    public function formatGet(): void
    {
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::get(false, 'MB'));
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::getPeak(false, 'MB'));
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::get(true, 'MB'));
        $this->assertStringMatchesFormat('%fMB', MemoryUsage::getPeak(true, 'MB'));
        $this->assertStringMatchesFormat('%fKB', MemoryUsage::get(false, 'kB'));
        $this->assertStringMatchesFormat('%fKB', MemoryUsage::getPeak(false, 'kB'));
        $this->assertStringMatchesFormat('%fKB', MemoryUsage::get(true, 'kB'));
        $this->assertStringMatchesFormat('%fKB', MemoryUsage::getPeak(true, 'kB'));
    }

    /** @test */
    public function intGetters(): void
    {
        $report = MemoryUsage::getReport();
        $this->assertIsInt($report->getUsage());
        $this->assertIsInt($report->getPeakUsage());
        $this->assertIsInt($report->getUsageReal());
        $this->assertIsInt($report->getPeakUsageReal());
        $this->assertNull($report->getUsageDiff());
        $this->assertNull($report->getPeakUsageDiff());
        $this->assertNull($report->getUsageRealDiff());
        $this->assertNull($report->getPeakUsageRealDiff());
    }

    /** @test */
    public function stringGetters(): void
    {
        $report = MemoryUsage::getReport();
        $this->assertIsString($report->getUsageString());
        $this->assertIsString($report->getPeakUsageString());
        $this->assertIsString($report->getUsageRealString());
        $this->assertIsString($report->getPeakUsageRealString());

        $this->assertStringMatchesFormat('%fMB', $report->getUsageString());
        $this->assertStringMatchesFormat('%fMB', $report->getPeakUsageString());
        $this->assertStringMatchesFormat('%fMB', $report->getUsageRealString());
        $this->assertStringMatchesFormat('%fMB', $report->getPeakUsageRealString());

        $report2 = MemoryUsage::diff($report);

        $this->assertIsString($report2->getUsageString());
        $this->assertIsString($report2->getPeakUsageString());
        $this->assertIsString($report2->getUsageRealString());
        $this->assertIsString($report2->getPeakUsageRealString());

        $this->assertStringMatchesFormat('%fMB', $report2->getUsageString());
        $this->assertStringMatchesFormat('%fMB', $report2->getPeakUsageString());
        $this->assertStringMatchesFormat('%fMB', $report2->getUsageRealString());
        $this->assertStringMatchesFormat('%fMB', $report2->getPeakUsageRealString());
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
            (string)MemoryUsage::getReport()
        );
    }

    // these tests just for lulz

    /** @test */
    public function itBehaves(): void
    {
        $this->assertEquals(format_bytes(memory_get_usage(), 'GB'), MemoryUsage::get(false, 'GB'));
        $this->assertEquals(format_bytes(memory_get_usage(true)), MemoryUsage::get(true));
        $this->assertEquals(format_bytes(memory_get_peak_usage()), MemoryUsage::getPeak());
        $this->assertIsString((string)MemoryUsage::getReport());
    }
}
