<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Orientation;

class OrientationMother
{
    public static function create(?string $orientation = null): Orientation
    {
        return new Orientation(
            orientation: $orientation ?? Orientation::NORTH,
        );
    }
}
