<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Orientation;
use PHPUnit\Framework\TestCase;

class OrientationTest extends TestCase
{
    private ?Orientation $sut = null;

    protected function setUp(): void
    {
        $this->sut = new Orientation(Orientation::NORTH);
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function orientationProvider()
    {
        return [
            'north' => [Orientation::NORTH, Orientation::NORTH],
            'east' => [Orientation::EAST, Orientation::EAST],
            'west' => [Orientation::WEST, Orientation::WEST],
            'south' => [Orientation::SOUTH, Orientation::SOUTH],
        ];
    }

    public function testItCannotFaceAnywhere()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Orientation('fake_orientation');
    }

    /** @dataProvider orientationProvider */
    public function testItMustBeFaceToTheCorrectSide(string $orientation, string $expected)
    {
        $sut = new Orientation($orientation);

        $this->assertEquals($expected, $sut->get());
    }

    public function testItCanChangeToSideNorth()
    {
        $this->sut->changeToNorth();
        $this->assertEquals(Orientation::NORTH, $this->sut->get());
    }

    public function testItCanChangeToSideEast()
    {
        $this->sut->changeToEast();
        $this->assertEquals(Orientation::EAST, $this->sut->get());
    }

    public function testItCanChangeToSideSouth()
    {
        $this->sut->changeToSouth();
        $this->assertEquals(Orientation::SOUTH, $this->sut->get());
    }

    public function testItCanChangeToSideWest()
    {
        $this->sut->changeToWest();
        $this->assertEquals(Orientation::WEST, $this->sut->get());
    }
}
