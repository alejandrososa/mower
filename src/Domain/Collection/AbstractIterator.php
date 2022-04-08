<?php

namespace Kata\Domain\Collection;

abstract class AbstractIterator implements \Iterator
{
    protected int $position = 0;

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
