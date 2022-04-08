<?php

namespace Kata\Domain\Mobility;

use Kata\Domain\Navigation\{
    Instruction,
    Location,
    Orientation
};

final class SpinLeftMove implements Move
{
    public function getType(): string
    {
        return Instruction::TURN_LEFT;
    }

    public function isMatch(string $type): bool
    {
        return $this->getType() === $type;
    }

    public function move(Location $location): Location
    {
        switch ($location->getOrientation()->get()) {
            case Orientation::NORTH:
                $location->getOrientation()->changeToWest();
                break;
            case Orientation::EAST:
                $location->getOrientation()->changeToNorth();
                break;
            case Orientation::SOUTH:
                $location->getOrientation()->changeToEast();
                break;
            case Orientation::WEST:
                $location->getOrientation()->changeToSouth();
                break;
        }

        return $location;
    }
}
