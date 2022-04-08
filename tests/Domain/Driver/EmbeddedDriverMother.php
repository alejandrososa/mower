<?php

namespace Kata\Tests\Domain\Driver;

use Kata\Domain\Driver\{Driver, EmbeddedDriver};
use Kata\Domain\Mobility\{
    MoveCollection,
    SpinLeftMove,
    SpinRightMove,
    StepForwardMove
};

class EmbeddedDriverMother
{
    public static function create(?MoveCollection $moveCollection = null): Driver
    {
        $collection = new MoveCollection();
        $collection->append(new SpinLeftMove());
        $collection->append(new SpinRightMove());
        $collection->append(new StepForwardMove());

        return new EmbeddedDriver(count($moveCollection) > 0 ? $moveCollection : $collection);
    }
}
