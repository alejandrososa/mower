<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Instruction;

class InstructionMother
{
    public static function create(?string $instruction = null): Instruction
    {
        return new Instruction($instruction ?? Instruction::TURN_RIGHT);
    }
}
