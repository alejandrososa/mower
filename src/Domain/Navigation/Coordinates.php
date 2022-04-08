<?php

namespace Kata\Domain\Navigation;

class Coordinates implements \Stringable
{
    public function __construct(private int $coordinateX, private int $coordinateY)
    {
    }

    public function __toString(): string
    {
        return sprintf('x: %d, y: %d,', $this->coordinateX, $this->coordinateY);
    }

    public function addToCoordinateX(): void
    {
        $this->coordinateX++;
    }

    public function subtractToCoordinateX(): void
    {
        $this->coordinateX--;
    }

    public function addToCoordinateY(): void
    {
        $this->coordinateY++;
    }

    public function subtractToCoordinateY(): void
    {
        $this->coordinateY--;
    }

    public function getX(): int
    {
        return $this->coordinateX;
    }

    public function getY(): int
    {
        return $this->coordinateY;
    }
}
