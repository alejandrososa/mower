<?php

namespace Kata\Domain\Input;

use Kata\Domain\Collection\AbstractCollection;

class LineCollection extends AbstractCollection
{
    public function getIterator(): \Iterator
    {
        return new LineIterator($this);
    }
}
