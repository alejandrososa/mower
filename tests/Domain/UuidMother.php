<?php

namespace Kata\Tests\Domain;

use Kata\Domain\Uuid;

class UuidMother
{
    public static function create(?string $id = null): Uuid
    {
        return $id ? Uuid::fromString($id) : Uuid::random();
    }
}
