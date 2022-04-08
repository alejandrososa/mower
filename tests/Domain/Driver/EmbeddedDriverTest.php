<?php

namespace Kata\Tests\Domain\Driver;

use Kata\Domain\Driver\Driver;
use Kata\Domain\Driver\EmbeddedDriver;
use Kata\Domain\Factory\EmbeddedDriverFactory;
use Kata\Tests\Domain\Navigation\InstructionMother;
use Kata\Tests\Domain\Navigation\LocationMother;
use PHPUnit\Framework\TestCase;

class EmbeddedDriverTest extends TestCase
{
    private ?Driver $sut = null;

    protected function setUp(): void
    {
        $this->sut = EmbeddedDriverFactory::create();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanCreateAEmbeddedDriver()
    {
        $this->assertInstanceOf(Driver::class, $this->sut);
        $this->assertInstanceOf(EmbeddedDriver::class, $this->sut);
    }

    public function locationAndInstructionsProvider()
    {
        return [
            'first' => [1, 2, 'N', 'LMLMLMLMM', '1 3 N'],
            'second' => [3, 3, 'E', 'MMRMMRMRRM', '5 1 E'],
        ];
    }

    /** @dataProvider locationAndInstructionsProvider */
    public function testItMustCalculateTheNewLocation(
        int $x,
        int $y,
        string $orientation,
        string $instructions,
        string $expected,
    )
    {
        $location = LocationMother::create($x, $y, $orientation);
        $instructions = InstructionMother::create($instructions);

        $newLocation = $this->sut->calculateNewLocationByInstruction($location, $instructions);

        $this->assertEquals($expected, (string)$newLocation);
    }
}
