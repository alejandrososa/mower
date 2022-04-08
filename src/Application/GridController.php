<?php

namespace Kata\Application;

class GridController
{
    public function __construct(private array $lines)
    {
    }

    public function getLines(): array
    {
        return $this->lines;
    }
}
