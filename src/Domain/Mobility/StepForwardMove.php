<?php

namespace Kata\Domain\Mobility;

use Kata\Domain\Navigation\{
    Instruction,
    Location,
    Orientation
};

final class StepForwardMove implements Move
{
    public function getType(): string
    {
        return Instruction::STEP_FORWARD;
    }

    public function isMatch(string $type): bool
    {
        return $this->getType() === $type;
    }

    public function move(Location $location): Location
    {
        switch ($location->getOrientation()->get()) {
            case Orientation::NORTH:
                $location->getCoordinates()->addToCoordinateY();
                break;
            case Orientation::EAST:
                $location->getCoordinates()->addToCoordinateX();
                break;
            case Orientation::SOUTH:
                $location->getCoordinates()->subtractToCoordinateY();
                break;
            case Orientation::WEST:
                $location->getCoordinates()->subtractToCoordinateX();
                break;
        }

        return $location;
    }
}
