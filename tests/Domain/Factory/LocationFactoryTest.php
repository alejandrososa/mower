<?php

namespace Kata\Tests\Domain\Factory;

use Kata\Domain\Factory\LocationFactory;
use Kata\Domain\Navigation\Location;
use Kata\Tests\Domain\Navigation\{CoordinatesMother, OrientationMother};
use PHPUnit\Framework\TestCase;

class LocationFactoryTest extends TestCase
{
    private ?Location $sut = null;

    protected function setUp(): void
    {
        $this->sut = LocationFactory::create(
            coordinateX: CoordinatesMother::create()->getX(),
            coordinateY: CoordinatesMother::create()->getY(),
            orientation: OrientationMother::create()->get(),
        );
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanCreateALocation()
    {
        $this->assertInstanceOf(Location::class, $this->sut);
    }
}
