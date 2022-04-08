<?php

namespace Kata\Tests\Application;

use Kata\Application\GridController;

class GridControllerMother
{
    public static function create(?array $lines = null): GridController
    {
        $fakeLines = [
            '5 5',
            '1 2 N',
            'LMLMLLLM',
        ];
        return new GridController($lines ?? $fakeLines);
    }
}
