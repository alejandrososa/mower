<?php

namespace Kata\Tests\Domain;

use Kata\Domain\Factory\EmbeddedDriverFactory;
use Kata\Domain\Navigation\{
    Coordinates,
    Location,
    Orientation,
};
use Kata\Domain\{Rover, Uuid};

final class RoverMother
{
    public static function create(
        ?int $x = null,
        ?int $y = null,
        ?string $orientation = null,
        ?string $id = null,
    ): Rover {
        $x = $x ?? random_int(0, 5);
        $y = $y ?? random_int(0, 5);
        $orientation = $orientation ?? Orientation::ALLOWED_ORIENTATIONS[random_int(0, 3)];
        $id = $id ? Uuid::fromString($id) : Uuid::random();

        $location = new Location(
            coordinates: new Coordinates($x, $y),
            orientation: new Orientation($orientation)
        );
        $rover = new Rover(id: $id, location: $location);
        $rover->addDriver(EmbeddedDriverFactory::create());

        return $rover;
    }
}
