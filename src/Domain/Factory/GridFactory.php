<?php

namespace Kata\Domain\Factory;

use Kata\Domain\Grid;
use Kata\Domain\Navigation\Coordinates;

class GridFactory
{
    public static function create(int $coordinateX, int $coordinateY): Grid
    {
        return new Grid(
            new Coordinates(
                coordinateX: $coordinateX,
                coordinateY: $coordinateY,
            )
        );
    }
}
