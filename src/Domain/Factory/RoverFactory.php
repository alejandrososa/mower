<?php

namespace Kata\Domain\Factory;

use Kata\Domain\{Rover, Uuid};

class RoverFactory
{
    public static function create(int $coordinateX, int $coordinateY, string $orientation): Rover
    {
        $location = LocationFactory::create($coordinateX, $coordinateY, $orientation);
        $embeddedDriver = EmbeddedDriverFactory::create();

        $rover = new Rover(id: Uuid::random(), location: $location);
        $rover->addDriver(driver: $embeddedDriver);

        return $rover;
    }
}
