<?php

namespace Kata\Tests\Domain\Mobility;

use Kata\Domain\Navigation\{Instruction, Orientation};
use Kata\Tests\Domain\Navigation\LocationMother;
use Kata\Domain\Mobility\SpinRightMove;
use PHPUnit\Framework\TestCase;

class SpinRightMoveTest extends TestCase
{
    private ?SpinRightMove $sut = null;

    protected function setUp(): void
    {
        $this->sut = new SpinRightMove();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function typeProvider()
    {
        return [
            'turn left' => [Instruction::TURN_LEFT, false],
            'turn right' => [Instruction::TURN_RIGHT, true],
            'step Forward' => [Instruction::STEP_FORWARD, false],
        ];
    }

    /** @dataProvider typeProvider */
    public function testItCanMatchTypes(string $type, bool $expected)
    {
        $this->assertEquals($expected, $this->sut->isMatch($type));
    }

    public function locationProvider()
    {
        return [
            'north' => [Orientation::NORTH, Orientation::EAST],
            'east' => [Orientation::EAST, Orientation::SOUTH],
            'south' => [Orientation::SOUTH, Orientation::WEST],
            'west' => [Orientation::WEST, Orientation::NORTH],
        ];
    }

    /** @dataProvider locationProvider */
    public function testItCanSpinToTheLeft(string $orientation, string $expected)
    {
        $location = LocationMother::create(orientation: $orientation);
        $newLocation = $this->sut->move($location);
        $this->assertEquals($expected, $newLocation->getOrientation()->get());
    }
}
