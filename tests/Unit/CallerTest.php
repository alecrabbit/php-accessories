<?php

declare(strict_types=1);

namespace AlecRabbit\Tests\Accessories;

use AlecRabbit\Accessories\Caller;
use PHPUnit\Framework\TestCase;

class CallerTest extends TestCase
{
    /** @test */
    public function caller(): void
    {
        dump(__METHOD__);
        dump(Caller::method());
        $this->assertTrue(true);
    }
}