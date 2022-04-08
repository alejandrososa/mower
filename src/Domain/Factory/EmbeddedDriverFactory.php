<?php

namespace Kata\Domain\Factory;

use Kata\Domain\Driver\{Driver, EmbeddedDriver};
use Kata\Domain\Mobility\{
    MoveCollection,
    SpinLeftMove,
    SpinRightMove,
    StepForwardMove,
};

class EmbeddedDriverFactory
{
    public static function create(): Driver
    {
        $collection = new MoveCollection();
        $collection->append(new SpinLeftMove());
        $collection->append(new SpinRightMove());
        $collection->append(new StepForwardMove());

        return new EmbeddedDriver($collection);
    }
}
