<?php

namespace Kata\Tests\Domain\Factory;

use Kata\Domain\Factory\GridFactory;
use Kata\Domain\Grid;
use Kata\Tests\Domain\Navigation\CoordinatesMother;
use PHPUnit\Framework\TestCase;

class GridFactoryTest extends TestCase
{
    private ?Grid $sut = null;

    protected function setUp(): void
    {
        $this->sut = GridFactory::create(
            coordinateX: CoordinatesMother::create()->getX(),
            coordinateY: CoordinatesMother::create()->getY(),
        );
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanCreateAGrid()
    {
        $this->assertInstanceOf(Grid::class, $this->sut);
    }
}
