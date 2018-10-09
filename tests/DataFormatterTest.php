<?php
/**
 * User: alec
 * Date: 09.10.18
 * Time: 23:33
 */
declare(strict_types=1);


use AlecRabbit\DataFormatter;
use PHPUnit\Framework\TestCase;

class DataFormatterTest extends TestCase
{
    /** @test */
    public function ProcessFormattingCorectly(): void
    {
        $this->assertEquals(
            '1.00KB',
            DataFormatter::format(1024)
        );
    }
}