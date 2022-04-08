<?php

namespace Kata\Domain\Mobility;

use Kata\Domain\Collection\AbstractCollection;

class MoveCollection extends AbstractCollection
{
    public function getIterator(): \Iterator
    {
        return new MoveIterator($this);
    }
}
