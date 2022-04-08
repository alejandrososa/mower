<?php

namespace Kata\Domain\Driver;

use Kata\Domain\Factory\LocationFactory;
use Kata\Domain\Mobility\{Move, MoveCollection};
use Kata\Domain\Navigation\{Instruction, Location};

class EmbeddedDriver implements Driver
{
    private ?Location $location = null;

    public function __construct(private MoveCollection $moveCollection)
    {
    }

    public function calculateNewLocationByInstruction(Location $location, Instruction $instruction): Location
    {
        $this->setCurrentLocation($location);

        foreach ($instruction->toArray() as $instruction) {
            /** @var Move $strategy */
            foreach ($this->moveCollection->getIterator() as $strategy) {
                if ($strategy->isMatch($instruction)) {
                    $this->location = $strategy->move($this->location);
                }
            }
        }

        return $this->location;
    }

    /**
     * Avoid working on the original location
     */
    private function setCurrentLocation(Location $location): void
    {
        $this->location = LocationFactory::fromLocation($location);
    }
}
