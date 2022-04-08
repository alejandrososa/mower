<?php

namespace Kata\Domain\Navigation;

class Orientation implements \Stringable
{
    public const NORTH = 'N';
    public const EAST = 'E';
    public const WEST = 'W';
    public const SOUTH = 'S';

    public const ALLOWED_ORIENTATIONS = [self::NORTH, self::EAST, self::WEST, self::SOUTH];

    public function __construct(private string $orientation)
    {
        $this->guardIsValidOrientation($orientation);
    }

    public function __toString(): string
    {
        return $this->orientation;
    }

    private function guardIsValidOrientation(string $instruction): void
    {
        if (false === in_array($instruction, self::ALLOWED_ORIENTATIONS, true)) {
            $message = sprintf('Orientation \'%s\' is invalid', $instruction);
            throw new \InvalidArgumentException($message);
        }
    }

    public function changeToNorth(): void
    {
        $this->orientation = self::NORTH;
    }

    public function changeToEast(): void
    {
        $this->orientation = self::EAST;
    }

    public function changeToSouth(): void
    {
        $this->orientation = self::SOUTH;
    }

    public function changeToWest(): void
    {
        $this->orientation = self::WEST;
    }

    public function get(): string
    {
        return $this->orientation;
    }
}
