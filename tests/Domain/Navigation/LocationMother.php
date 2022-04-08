<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Coordinates;
use Kata\Domain\Navigation\Location;
use Kata\Domain\Navigation\Orientation;

class LocationMother
{
    public static function create(
        ?int $coordinateX = null,
        ?int $coordinateY = null,
        ?string $orientation = null
    ): Location {
        return new Location(
            coordinates: new Coordinates(
                !is_null($coordinateX) ? $coordinateX : random_int(0 ,5),
                !is_null($coordinateY) ? $coordinateY : random_int(0 ,5),
            ),
            orientation: new Orientation($orientation ?? Orientation::NORTH),
        );
    }
}
