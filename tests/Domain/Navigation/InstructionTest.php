<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\Instruction;
use PHPUnit\Framework\TestCase;

class InstructionTest extends TestCase
{
    public const INVALID_DRIVING_INSTRUCTION = 'GO';

    public function instructionProvider()
    {
        return [
            'move forward' => [Instruction::STEP_FORWARD, Instruction::STEP_FORWARD],
            'turn left' => [Instruction::TURN_LEFT, Instruction::TURN_LEFT],
            'turn right' => [Instruction::TURN_RIGHT, Instruction::TURN_RIGHT],
        ];
    }

    public function testItCannotHaveInvalidInstructions()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Instruction(self::INVALID_DRIVING_INSTRUCTION);
    }

    /** @dataProvider instructionProvider */
    public function testItHasADrivingInstructions(string $instructions, string $expected)
    {
        $sut = new Instruction($instructions);

        $this->assertEquals($expected, $sut->get());
    }
}
