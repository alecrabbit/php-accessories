<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Core\AbstractReport;
use AlecRabbit\Reports\Core\Reportable;
use AlecRabbit\Reports\Contracts\ReportInterface;
use PHPUnit\Framework\TestCase;

class CallerDataTest extends TestCase
{
    /** @test */
    public function buildOn(): void
    {
        $report = new CallerData();
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
