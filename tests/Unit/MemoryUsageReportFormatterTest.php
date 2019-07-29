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
        $this->assertEquals('Memory: 9.8KB(64.0KB) Peak: 12.1KB(128.0KB)', (string)$report);
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 9.766KB(64.000KB) Peak: 12.056KB(128.000KB)', (string)$report);
        $formatter->setDecimals(5);
        $this->assertEquals('Memory: 9.766KB(64.000KB) Peak: 12.056KB(128.000KB)', (string)$report);
        $formatter->setUnits('mb');
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 0.010MB(0.063MB) Peak: 0.012MB(0.125MB)', (string)$report);

        $report2 =
            (new MemoryUsageReport(
                10000,
                12345,
                1024 * 64,
                1024 * 128,
                $formatter
            ))->diff($report);
        $formatter->setUnits('kb');
        $formatter->setDecimals(1);
        $this->assertEquals('Memory: 9.8KB(64.0KB) Peak: 12.1KB(128.0KB)', (string)$report2);
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 9.766KB(64.000KB) Peak: 12.056KB(128.000KB)', (string)$report2);
        $formatter->setDecimals(5);
        $this->assertEquals('Memory: 9.766KB(64.000KB) Peak: 12.056KB(128.000KB)', (string)$report2);
        $formatter->setUnits('mb');
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 0.010MB(0.063MB) Peak: 0.012MB(0.125MB)', (string)$report2);

        $report3 =
            (new MemoryUsageReport(
                20000,
                22345,
                2024 * 64,
                2024 * 128,
                $formatter
            ))->diff($report);
        $formatter->setUnits('kb');
        $formatter->setDecimals(1);
        $this->assertEquals(
            'Memory: 19.5KB(126.5KB) Peak: 21.8KB(253.0KB) Diff: 9.77KB(62.50KB) 9.77KB(125.00KB)',
            (string)$report3
        );
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 19.531KB(126.500KB) Peak: 21.821KB(253.000KB) Diff: 9.77KB(62.50KB) 9.77KB(125.00KB)', (string)$report3);
        $formatter->setDecimals(5);
        $this->assertEquals('Memory: 19.531KB(126.500KB) Peak: 21.821KB(253.000KB) Diff: 9.77KB(62.50KB) 9.77KB(125.00KB)', (string)$report3);
        $formatter->setUnits('mb');
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 0.019MB(0.124MB) Peak: 0.021MB(0.247MB) Diff: 9.77KB(62.50KB) 9.77KB(125.00KB)', (string)$report3);

        $report4 =
            (new MemoryUsageReport(
                9920000,
                9922345,
                92024 * 64,
                92024 * 128,
                $formatter
            ))->diff($report);
        $formatter->setUnits('kb');
        $formatter->setDecimals(1);
        $this->assertEquals(
            'Memory: 9687.5KB(5751.5KB) Peak: 9689.8KB(11503.0KB) Diff: 9.45MB(5.55MB) 9.45MB(11.11MB)',
            (string)$report4
        );
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 9687.500KB(5751.500KB) Peak: 9689.790KB(11503.000KB) Diff: 9.45MB(5.55MB) 9.45MB(11.11MB)', (string)$report4);
        $formatter->setDecimals(5);
        $this->assertEquals('Memory: 9687.500KB(5751.500KB) Peak: 9689.790KB(11503.000KB) Diff: 9.45MB(5.55MB) 9.45MB(11.11MB)', (string)$report4);
        $formatter->setUnits('mb');
        $formatter->setDecimals(3);
        $this->assertEquals('Memory: 9.460MB(5.617MB) Peak: 9.463MB(11.233MB) Diff: 9.45MB(5.55MB) 9.45MB(11.11MB)', (string)$report4);

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
