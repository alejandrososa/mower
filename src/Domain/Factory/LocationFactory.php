<?php

namespace Kata\Domain\Factory;

use Kata\Domain\Navigation\{
    Coordinates,
    Location,
    Orientation,
};

class LocationFactory
{
    public static function create(int $coordinateX, int $coordinateY, string $orientation): Location
    {
        return new Location(
            coordinates: new Coordinates($coordinateX, $coordinateY),
            orientation: new Orientation($orientation)
        );
    }

    public static function fromLocation(Location $location)
    {
        return self::create(
            coordinateX: $location->getCoordinates()->getX(),
            coordinateY: $location->getCoordinates()->getY(),
            orientation: $location->getOrientation()->get()
        );
    }
}
