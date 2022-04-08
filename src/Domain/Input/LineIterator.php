<?php

namespace Kata\Domain\Input;

use Kata\Domain\Collection\AbstractIterator;

class LineIterator extends AbstractIterator
{
    public function __construct(private LineCollection $collection)
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
