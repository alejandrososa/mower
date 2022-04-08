<?php

namespace Kata\Domain\Mobility;

use Kata\Domain\Collection\AbstractIterator;

class MoveIterator extends AbstractIterator
{
    public function __construct(private MoveCollection $collection)
    {
    }

    public function current(): mixed
    {
        return $this->collection->getElements()[$this->position];
    }

    public function valid(): bool
    {
        return isset($this->collection->getElements()[$this->position]);
    }
}
