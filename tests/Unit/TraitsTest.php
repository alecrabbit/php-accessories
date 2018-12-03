<?php
/**
 * User: alec
 * Date: 04.12.18
 * Time: 0:02
 */

namespace Unit;


use const AlecRabbit\Constants\Accessories\DEFAULT_NAME;
use AlecRabbit\Traits\Nameable;
use PHPUnit\Framework\TestCase;

class TraitsTesting
{
    use Nameable;

    /**
     * TraitsTesting constructor.
     * @param null $name
     */
    public function __construct($name = null)
    {
        $this->name = $this->defaultName($name);
    }
}

class TraitsTest extends TestCase
{
    /** @var TraitsTesting */
    private $obj;

    protected function setUp()
    {
        $this->obj = new TraitsTesting();
    }

    /** @test */
    public function check(): void
    {
        $this->assertEquals(DEFAULT_NAME, $this->obj->getName());
        $this->assertInstanceOf(TraitsTesting::class, $this->obj->setName('new'));
        $this->assertEquals('new', $this->obj->getName());
    }

}