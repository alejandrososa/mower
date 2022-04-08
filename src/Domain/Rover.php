<?php

namespace Kata\Domain;

use Kata\Domain\Driver\Driver;
use Kata\Domain\Navigation\{Instruction, Location};

class Rover implements \Stringable
{
    private ?Driver $embeddedDriver = null;

    public function __construct(private Uuid $id, private Location $location)
    {
    }

    public function __toString(): string
    {
        return (string)$this->location;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function addDriver(Driver $driver): self
    {
        $this->embeddedDriver = $driver;

        return $this;
    }

    public function move(Instruction $instructions)
    {
        $newLocation = $this->processTheInstructions($instructions);

        $this->location = $newLocation;
    }

    public function getFutureLocationBy(Instruction $instructions): Location
    {
        return $this->processTheInstructions($instructions);
    }

    private function processTheInstructions(Instruction $instructions): Location
    {
        if (!$this->embeddedDriver instanceof Driver) {
            throw new \InvalidArgumentException('Driver has not been provisioned');
        }

        return $this->embeddedDriver
            ->calculateNewLocationByInstruction($this->location, $instructions);
    }
}
