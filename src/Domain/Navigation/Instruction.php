<?php

namespace Kata\Domain\Navigation;

class Instruction
{
    public const STEP_FORWARD = 'M';
    public const TURN_LEFT = 'L';
    public const TURN_RIGHT = 'R';
    public const ALLOWED_COMMANDS = [self::STEP_FORWARD, self::TURN_RIGHT, self::TURN_LEFT];

    public function __construct(private string $instruction)
    {
        $this->guardAreValidInstructions($instruction);
    }

    public function guardAreValidInstructions(string $instruction): void
    {
        if (!$this->isValid($instruction)) {
            $message = sprintf('Instructions \'%s\' are invalid', $instruction);
            throw new \InvalidArgumentException($message);
        }
    }

    private function isValid(string $instruction): bool
    {
        $invalidCommands = [];
        $instructions = str_split($instruction);
        foreach ($instructions as $command) {
            if (!in_array($command, self::ALLOWED_COMMANDS)) {
                $invalidCommands[] = $command;
            }
        }
        return empty($invalidCommands);
    }

    public function get(): string
    {
        return $this->instruction;
    }

    public function toArray(): array
    {
        return str_split($this->instruction);
    }
}
