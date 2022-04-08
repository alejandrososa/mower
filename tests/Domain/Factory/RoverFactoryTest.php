<?php

namespace Kata\Tests\Domain\Factory;

use Kata\Domain\Factory\RoverFactory;
use Kata\Domain\Rover;
use Kata\Tests\Domain\Navigation\{CoordinatesMother, OrientationMother};
use PHPUnit\Framework\TestCase;

class RoverFactoryTest extends TestCase
{
    private ?Rover $sut = null;

    protected function setUp(): void
    {
        $this->sut = RoverFactory::create(
            coordinateX: CoordinatesMother::create()->getX(),
            coordinateY: CoordinatesMother::create()->getY(),
            orientation: OrientationMother::create()->get(),
        );
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanCreateARover()
    {
        $this->assertInstanceOf(Rover::class, $this->sut);
    }
}
