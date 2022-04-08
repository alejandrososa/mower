<?php

namespace Kata\Tests\Domain\Mobility;

use Kata\Domain\Navigation\{Instruction, Orientation};
use Kata\Tests\Domain\Navigation\LocationMother;
use Kata\Domain\Mobility\StepForwardMove;
use PHPUnit\Framework\TestCase;

class StepForwardMoveTest extends TestCase
{
    private ?StepForwardMove $sut = null;

    protected function setUp(): void
    {
        $this->sut = new StepForwardMove();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function typeProvider()
    {
        return [
            'turn left' => [Instruction::TURN_LEFT, false],
            'turn right' => [Instruction::TURN_RIGHT, false],
            'step Forward' => [Instruction::STEP_FORWARD, true],
        ];
    }

    /** @dataProvider typeProvider */
    public function testItCanMatchTypes(string $type, bool $expected)
    {
        $this->assertEquals($expected, $this->sut->isMatch($type));
    }

    public function locationProvider()
    {
        $x = 1;
        $y = 1;
        $point = 1;

        return [
            'north' => [$x, $x, Orientation::NORTH, $x, ($y + $point)],
            'east' => [$x, $x, Orientation::EAST, ($x + $point), $y],
            'south' => [$x, $x, Orientation::SOUTH, $x, ($y - $point)],
            'west' => [$x, $x, Orientation::WEST, ($x - $point), $y],
        ];
    }

    /** @dataProvider locationProvider */
    public function testItCanSpinToTheLeft(
        int $x,
        int $y,
        string $orientation,
        int $expectedX,
        int $expectedY
    ) {
        $location = LocationMother::create(
            coordinateX: $x,
            coordinateY: $y,
            orientation: $orientation
        );
        $newLocation = $this->sut->move($location);
        $this->assertEquals($expectedX, $newLocation->getCoordinates()->getX());
        $this->assertEquals($expectedY, $newLocation->getCoordinates()->getY());
    }
}
