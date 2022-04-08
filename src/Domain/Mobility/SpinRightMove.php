<?php

namespace Kata\Domain\Mobility;

use Kata\Domain\Navigation\{
    Instruction,
    Location,
    Orientation
};

final class SpinRightMove implements Move
{
    public function getType(): string
    {
        return Instruction::TURN_RIGHT;
    }

    public function isMatch(string $type): bool
    {
        return $this->getType() === $type;
    }

    public function move(Location $location): Location
    {
        switch ($location->getOrientation()->get()) {
            case Orientation::NORTH:
                $location->getOrientation()->changeToEast();
                break;
            case Orientation::EAST:
                $location->getOrientation()->changeToSouth();
                break;
            case Orientation::SOUTH:
                $location->getOrientation()->changeToWest();
                break;
            case Orientation::WEST:
                $location->getOrientation()->changeToNorth();
                break;
        }

        return $location;
    }
}
