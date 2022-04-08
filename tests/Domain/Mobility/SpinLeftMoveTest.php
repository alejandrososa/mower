<?php

namespace Kata\Tests\Domain\Mobility;

use Kata\Domain\Navigation\{Instruction, Orientation};
use Kata\Tests\Domain\Navigation\LocationMother;
use Kata\Domain\Mobility\SpinLeftMove;
use PHPUnit\Framework\TestCase;

class SpinLeftMoveTest extends TestCase
{
    private ?SpinLeftMove $sut = null;

    protected function setUp(): void
    {
        $this->sut = new SpinLeftMove();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function typeProvider()
    {
        return [
            'turn left' => [Instruction::TURN_LEFT, true],
            'turn right' => [Instruction::TURN_RIGHT, false],
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
            'north' => [Orientation::NORTH, Orientation::WEST],
            'east' => [Orientation::EAST, Orientation::NORTH],
            'south' => [Orientation::SOUTH, Orientation::EAST],
            'west' => [Orientation::WEST, Orientation::SOUTH],
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
