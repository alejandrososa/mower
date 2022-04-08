<?php

namespace Kata\Tests\Application;

use Kata\Application\GridControllerHandler;
use Kata\Domain\Grid;
use PHPUnit\Framework\TestCase;

class GridControllerHandlerTest extends TestCase
{
    private ?GridControllerHandler $sut = null;

    protected function setUp(): void
    {
        $this->sut = new GridControllerHandler();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanCreateAGridWithRoversFromLines()
    {
        $gridController = GridControllerMother::create();
        $grid = $this->sut->__invoke($gridController);

        $this->assertInstanceOf(Grid::class, $grid);
        $this->assertCount(1, $grid->getLocationsOccupied());
    }
}
