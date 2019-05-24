<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller;
use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\CallerDataFormatter;
use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use AlecRabbit\Reports\Contracts\ReportableInterface;
use AlecRabbit\Reports\Contracts\ReportInterface;
use AlecRabbit\Reports\Core\AbstractReport;
use PHPUnit\Framework\TestCase;

class CallerDataFormatterTest extends TestCase
{
    public const FUNCTION_NAME = 'name';
    public const FILE_PHP = 'file.php';
    public const LINE = 10;
    public const SOME_CLASS = 'SomeClass';
    public const TYPE = '->';
    public const ARGS = [1, 2];

//    /** @test */
//    public function wrongOptions(): void
//    {
//        $this->expectException(\RuntimeException::class);
//        new CallerDataFormatter('');
//    }
//

//    /** @test */
//    public function wrongInstance(): void
//    {
//        $formatter = Caller::getFormatter();
//        $str = $formatter->format(
//            new class extends AbstractReport
//            {
//                /**
//                 * @return string
//                 */
//                public function __toString(): string
//                {
//                    return '';
//                }
//
//                /**
//                 * @param ReportableInterface $reportable
//                 * @return ReportInterface
//                 */
//                public function buildOn(ReportableInterface $reportable): ReportInterface
//                {
//                    return $this;
//                }
//            }
//        );
//        $this->assertStringContainsString(CallerData::class, $str);
//        $this->assertStringContainsString('expected', $str);
//        $this->assertStringContainsString(__FILE__, $str);
//        $this->assertStringContainsString('given', $str);
//    }

    /** @test */
    public function doNotShowLineAndFile(): void
    {
        $c = new Caller();
        $formatter = new CallerDataFormatter(0);
        $stdClass = new \stdClass();
        $caller = [
            CallerConstants::FUNCTION => self::FUNCTION_NAME,
            CallerConstants::FILE => self::FILE_PHP,
            CallerConstants::LINE => self::LINE,
            CallerConstants::CLS => self::SOME_CLASS,
            CallerConstants::OBJECT => $stdClass,
            CallerConstants::TYPE => self::TYPE,
            CallerConstants::ARGS => self::ARGS,
        ];
        $c->setData($caller);

        $str = $formatter->format(new CallerData(null, $c));
        $this->assertStringNotContainsString((string)self::LINE, $str);
        $this->assertStringNotContainsString(self::FILE_PHP, $str);
        $this->assertStringContainsString(self::FUNCTION_NAME, $str);
        $this->assertStringContainsString(self::SOME_CLASS, $str);
        $this->assertStringContainsString(self::TYPE, $str);
        $this->assertStringContainsString('()', $str);
    }

    /** @test */
    public function showLineAndFile(): void
    {
        $c = new Caller();
        $formatter = new CallerDataFormatter();
        $stdClass = new \stdClass();
        $caller = [
            CallerConstants::FUNCTION => self::FUNCTION_NAME,
            CallerConstants::FILE => self::FILE_PHP,
            CallerConstants::LINE => self::LINE,
            CallerConstants::CLS => self::SOME_CLASS,
            CallerConstants::OBJECT => $stdClass,
            CallerConstants::TYPE => self::TYPE,
            CallerConstants::ARGS => self::ARGS,
        ];
        $c->setData($caller);

        $str = $formatter->format(new CallerData(null, $c));
        $this->assertStringContainsString((string)self::LINE, $str);
        $this->assertStringContainsString(self::FILE_PHP, $str);
        $this->assertStringContainsString(self::FUNCTION_NAME, $str);
        $this->assertStringContainsString(self::SOME_CLASS, $str);
        $this->assertStringContainsString(self::TYPE, $str);
        $this->assertStringContainsString('()', $str);
    }

    /** @test */
    public function undefined(): void
    {
        $caller = new Caller();
        $formatter = new CallerDataFormatter();
        $caller->setData(CallerConstants::UNDEFINED);
        $str = $formatter->format(new CallerData(null, $caller));
        $this->assertStringContainsString(CallerConstants::STR_UNDEFINED, strtolower($str));
        $this->assertStringNotContainsString('()', $str);
    }

    /** @test */
    public function wrongInstance(): void
    {
        $mu = new Caller();
        $formatter = new CallerDataFormatter();
        $mu->setFormatter($formatter);
        $str = $formatter->format(
            new class extends AbstractReport
            {
            }
        );
        $this->assertStringContainsString(CallerData::class, $str);
        $this->assertStringContainsString('expected', $str);
        $this->assertStringContainsString(__FILE__, $str);
        $this->assertStringContainsString('given', $str);
    }

}
