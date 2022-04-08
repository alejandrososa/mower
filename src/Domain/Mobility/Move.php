<?php

namespace Kata\Domain\Mobility;

use Kata\Domain\Navigation\Location;

interface Move
{
    public function isMatch(string $type): bool;
    public function getType(): string;
    public function move(Location $location): Location;
}
