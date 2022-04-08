<?php

namespace Kata\Tests\Domain;

use Kata\Domain\Grid;
use Kata\Domain\Navigation\{Coordinates, Orientation};
use Kata\Tests\Domain\Navigation\InstructionMother;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public const MAX_COORDINATE_X = 5;
    public const MAX_COORDINATE_Y = 5;
    public const MIN_COORDINATE_X = 0;
    public const MIN_COORDINATE_Y = 0;

    private ?Coordinates $maxCoordinates = null;
    private ?Grid $sut = null;

    protected function setUp(): void
    {
        $this->maxCoordinates = new Coordinates(self::MAX_COORDINATE_X, self::MAX_COORDINATE_Y);
        $this->sut = $this->createGrid($this->maxCoordinates);
    }

    protected function tearDown(): void
    {
        $this->sub = null;
        $this->maxCoordinates = null;
    }

    protected function createGrid(Coordinates $coordinates): Grid
    {
        return new Grid($coordinates);
    }

    public function testItHasMaxCoordinates()
    {
        $this->assertEquals(self::MAX_COORDINATE_X, $this->sut->getMaxCoordinates()->getX());
        $this->assertEquals(self::MAX_COORDINATE_Y, $this->sut->getMaxCoordinates()->getY());
    }

    public function testItHasMinCoordinates()
    {
        $this->assertEquals(self::MIN_COORDINATE_X, $this->sut->getMinCoordinates()->getX());
        $this->assertEquals(self::MIN_COORDINATE_Y, $this->sut->getMinCoordinates()->getY());
    }

    public function testThrowAnExceptionIfMaxCoordinatesIsLessThanMinCoordinates()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->createGrid(new Coordinates(-1, -10));
    }

    public function testThrowAnExceptionIfLocationIsNotAvailableWhenAddNewRover()
    {
        $this->expectException(\InvalidArgumentException::class);

        $roverOne = RoverMother::create(
            x: self::MAX_COORDINATE_X,
            y: self::MAX_COORDINATE_Y,
            orientation: Orientation::NORTH
        );
        $roverTwo = RoverMother::create(
            x: self::MAX_COORDINATE_X,
            y: self::MAX_COORDINATE_Y,
            orientation: Orientation::NORTH
        );
        $this->sut->addRover($roverOne);
        $this->sut->addRover($roverTwo);
    }

    public function testThrowAnExceptionIfTheRoverLocationExceedTheMaxLimits()
    {
        $this->expectException(\InvalidArgumentException::class);

        $roverOne = RoverMother::create(
            x: self::MAX_COORDINATE_X + 1,
            y: self::MAX_COORDINATE_Y + 1,
            orientation: Orientation::NORTH
        );
        $this->sut->addRover($roverOne);
    }

    public function testThrowAnExceptionIfTheRoverLocationExceedTheMinLimits()
    {
        $this->expectException(\InvalidArgumentException::class);

        $roverOne = RoverMother::create(
            x: self::MIN_COORDINATE_X - 1,
            y: self::MIN_COORDINATE_Y - 1,
            orientation: Orientation::NORTH
        );
        $this->sut->addRover($roverOne);
    }

    public function testItCanAddRovers()
    {
        $roverOne = RoverMother::create(orientation: Orientation::NORTH);
        $roverTwo = RoverMother::create(orientation: Orientation::EAST);
        $roverThree = RoverMother::create(orientation: Orientation::SOUTH);
        $this->sut->addRover($roverOne);
        $this->sut->addRover($roverTwo);
        $this->sut->addRover($roverThree);

        $locationsOccupied = $this->sut->getLocationsOccupied();

        $this->assertContains((string)$roverOne->getLocation(), $locationsOccupied);
        $this->assertContains((string)$roverTwo->getLocation(), $locationsOccupied);
        $this->assertContains((string)$roverThree->getLocation(), $locationsOccupied);
    }

    public function testItSkipTheInstructionsIfThereAreNoRoversOnTheGrid()
    {
        $id = UuidMother::create();
        $instruction = InstructionMother::create();
        $this->sut->sendInstructionsToRover($id, $instruction);
        $locationsOccupied = $this->sut->getLocationsOccupied();

        $this->assertEmpty($locationsOccupied);
    }
}
