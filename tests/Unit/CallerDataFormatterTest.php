<?php declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller\CallerData;
use AlecRabbit\Accessories\Caller\CallerDataFormatter;
use AlecRabbit\Accessories\Caller\Contracts\CallerConstants;
use PHPUnit\Framework\TestCase;

class CallerDataFormatterTest extends TestCase
{
    public const FUNCTION_NAME = 'name';
    public const FILE_PHP = 'file.php';
    public const LINE = 10;
    public const SOME_CLASS = 'SomeClass';
    public const TYPE = '->';
    public const ARGS = [1, 2];

    /** @test */
    public function wrongOptions(): void
    {
        $this->expectException(\RuntimeException::class);
        new CallerDataFormatter('');
    }

    /** @test */
    public function doNotShowLineAndFile(): void
    {
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
        $str = $formatter->process(new CallerData($caller));
        $this->assertNotContains((string)self::LINE, $str);
        $this->assertNotContains(self::FILE_PHP, $str);
        $this->assertContains(self::FUNCTION_NAME, $str);
        $this->assertContains(self::SOME_CLASS, $str);
        $this->assertContains(self::TYPE, $str);
        $this->assertContains('()', $str);
    }

    /** @test */
    public function undefined(): void
    {
        $formatter = new CallerDataFormatter();
        $str = $formatter->process(new CallerData(CallerConstants::UNDEFINED));
        $this->assertContains(CallerConstants::STR_UNDEFINED, strtolower($str));
        $this->assertNotContains('()', $str);
    }
}
