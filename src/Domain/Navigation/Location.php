<?php

namespace Kata\Domain\Navigation;

class Location implements \Stringable
{
    public function __construct(private Coordinates $coordinates, private Orientation $orientation)
    {
    }

    public function __toString(): string
    {
        return sprintf(
            '%d %d %s',
            $this->coordinates->getX(),
            $this->coordinates->getY(),
            $this->orientation->get(),
        );
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }
}
