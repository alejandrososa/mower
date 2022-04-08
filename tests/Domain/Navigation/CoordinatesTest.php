<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Coordinates;
use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    private ?Coordinates $sut = null;
    private ?int $coordinateX = null;
    private ?int $coordinateY = null;

    protected function setUp(): void
    {
        $this->coordinateX = 1;
        $this->coordinateY = 5;
        $this->sut = new Coordinates(
            coordinateX: $this->coordinateX,
            coordinateY: $this->coordinateY
        );
    }

    protected function tearDown(): void
    {
        $this->sut = null;
        $this->coordinateX = null;
        $this->coordinateY = null;
    }

    public function testItImplementStringableInterface()
    {
        $this->assertInstanceOf(\Stringable::class, $this->sut);
        $this->assertIsString((string)$this->sut);
    }

    public function testItCanAddPointToCoordinateX()
    {
        $expectedValue = $this->coordinateX + 1;
        $this->sut->addToCoordinateX();
        $this->assertEquals($expectedValue, $this->sut->getX());
    }

    public function testItCanSubtractPointToCoordinateX()
    {
        $expectedValue = $this->coordinateX - 1;
        $this->sut->subtractToCoordinateX();
        $this->assertEquals($expectedValue, $this->sut->getX());
    }

    public function testItCanAddPointToCoordinateY()
    {
        $expectedValue = $this->coordinateY + 1;
        $this->sut->addToCoordinateY();
        $this->assertEquals($expectedValue, $this->sut->getY());
    }

    public function testItCanSubtractPointToCoordinateY()
    {
        $expectedValue = $this->coordinateY - 1;
        $this->sut->subtractToCoordinateY();
        $this->assertEquals($expectedValue, $this->sut->getY());
    }
}
