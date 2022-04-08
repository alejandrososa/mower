<?php

namespace Kata\Application;

class ReadInstructionsFromResourcesHandler
{
    public const FILE = 'resources/instructions.txt';

    public function __invoke(ReadInstructionsFromResources $command): array
    {
        $file = sprintf('%s/%s', dirname(dirname(__DIR__)), self::FILE);

        if (!$this->guardFileExists($file)) {
            return [];
        }

        return file($file, FILE_IGNORE_NEW_LINES);
    }

    private function guardFileExists(string $file): bool
    {
        return file_exists($file);
    }
}
