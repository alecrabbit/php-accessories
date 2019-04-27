<?php

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\MemoryUsage\MemoryUsageReport;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\AbstractReport;
use AlecRabbit\Reports\Core\Reportable;
use PHPUnit\Framework\TestCase;

class MemoryUsageReportTest extends TestCase
{
    /** @test */
    public function buildOn(): void
    {
        $report = new MemoryUsageReport();
        $this->expectException(\InvalidArgumentException::class);
        $report->buildOn(
            new class extends Reportable
            {
                protected function createEmptyReport(): ReportInterface
                {
                    return
                        new class extends AbstractReport
                        {
                            /**
                             * @return string
                             */
                            public function __toString(): string
                            {
                                return '';
                            }

                            /**
                             * @param ReportableInterface $reportable
                             * @return ReportInterface
                             */
                            public function buildOn(ReportableInterface $reportable): ReportInterface
                            {
                                return $this;
                            }
                        };
                }
            }
        );
    }
}
