<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Coordinates;

class CoordinatesMother
{
    public static function create(?int $coordinateX = null, ?int $coordinateY = null): Coordinates
    {
        return new Coordinates(
            coordinateX: !is_null($coordinateX) ? $coordinateX : random_int(1, 5),
            coordinateY: !is_null($coordinateY) ? $coordinateY : random_int(1, 5)
        );
    }
}
