<?php

namespace Kata\Tests\Domain;

use Kata\Domain\Driver\Driver;
use Kata\Domain\Factory\EmbeddedDriverFactory;
use Kata\Domain\Navigation\{
    Coordinates,
    Instruction,
    Location,
    Orientation,
};
use Kata\Domain\{Rover, Uuid};
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    public const X = 1;
    public const Y = 2;
    public const ONE_STEP = 1;

    private ?Rover $sut = null;
    private ?Driver $driver = null;

    protected function setUp(): void
    {
        $this->driver = EmbeddedDriverFactory::create();

        $this->sut = $this->createRover(
            x: self::X,
            y: self::Y,
            orientation: Orientation::NORTH,
            id: '8aa42bc4-f87e-48b5-a395-9e861449ebbf'
        );
    }

    protected function tearDown(): void
    {
        $this->sub = null;
        $this->driver = null;
    }

    public function createRover(int $x, int $y, string $orientation, string $id): Rover
    {
        return new Rover(
            id: Uuid::fromString($id),
            location: $this->createLocation($x, $y, $orientation)
        );
    }

    public function createLocation(int $x, int $y, string $orientation)
    {
        return new Location(
            coordinates: new Coordinates($x, $y),
            orientation: new Orientation($orientation)
        );
    }

    public function testItHasACoordinates()
    {
        $this->assertEquals(self::X, $this->sut->getLocation()->getCoordinates()->getX());
        $this->assertEquals(self::Y, $this->sut->getLocation()->getCoordinates()->getY());
    }

    public function testItHasAnOrientation()
    {
        $this->assertEquals(Orientation::NORTH, $this->sut->getLocation()->getOrientation()->get());
    }

    public function testThrowAnExceptionIfTheEmbeddedDriverHaveNotProvisioned()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->sut->move(new Instruction(Instruction::TURN_LEFT));
    }

    public function testItCanSpinToLeft()
    {
        $this->sut->addDriver($this->driver);
        $this->sut->move(new Instruction(Instruction::TURN_LEFT));

        $this->assertEquals(Orientation::WEST, $this->sut->getLocation()->getOrientation()->get());
    }

    public function testItCanSpinToRight()
    {
        $this->sut->addDriver($this->driver);
        $this->sut->move(new Instruction(Instruction::TURN_RIGHT));

        $this->assertEquals(Orientation::EAST, $this->sut->getLocation()->getOrientation()->get());
    }

    public function testItCanStepForward()
    {
        $this->sut->addDriver($this->driver);
        $this->sut->move(new Instruction(Instruction::STEP_FORWARD));

        $expectedCoordinateY = self::Y + self::ONE_STEP;
        $this->assertEquals($expectedCoordinateY, $this->sut->getLocation()->getCoordinates()->getY());
    }

    public function instructionsProvider()
    {
        $idOne = '9589d50d-be2d-4c95-b997-173b789968be';

        $idTwo = '6990f360-c77f-4000-ae7c-fde5c9e3efc6';

        return [
            '1 2 N' => [$idOne, 1, 2, Orientation::NORTH, 'LMLMLMLMM', '1 3 N'],
            '3 3 E' => [$idTwo, 3, 3, Orientation::EAST, 'MMRMMRMRRM', '5 1 E'],
        ];
    }

    /** @dataProvider instructionsProvider */
    public function testItCanMoveByInstructions(
        string $id,
        int $x,
        int $y,
        string $orientation,
        string $instructions,
        string $expected
    ) {
        $this->sut = $this->createRover($x, $y, $orientation, $id);

        $this->sut->addDriver($this->driver);
        $this->sut->move(new Instruction($instructions));

        $this->assertEquals($expected, (string)$this->sut);
    }

    /** @dataProvider instructionsProvider */
    public function testItCanCalculateNewLocationByInstructionWithoutChangeCurrentLocation(
        string $id,
        int $x,
        int $y,
        string $orientation,
        string $instructions,
        string $expected
    ) {
        $this->sut = $this->createRover($x, $y, $orientation, $id);
        $location = $this->createLocation($x, $y, $orientation);

        $this->sut->addDriver($this->driver);
        $futureLocation = $this->sut->getFutureLocationBy(new Instruction($instructions));

        $this->assertNotEquals($futureLocation, $this->sut->getLocation());
        $this->assertEquals($location, $this->sut->getLocation());
        $this->assertEquals($expected, (string)$futureLocation);
    }
}
