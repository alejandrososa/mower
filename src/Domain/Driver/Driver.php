<?php

namespace Kata\Domain\Driver;

use Kata\Domain\Navigation\{Instruction, Location};

interface Driver
{
    public function calculateNewLocationByInstruction(Location $location, Instruction $instruction): Location;
}
