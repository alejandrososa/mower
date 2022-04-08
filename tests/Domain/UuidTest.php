<?php

namespace Kata\Tests\Domain;

use Kata\Domain\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    private ?string $uuidValid = null;

    protected function setUp(): void
    {
        $this->uuidValid = '8aa42bc4-f87e-48b5-a395-9e861449ebbf';
    }

    protected function tearDown(): void
    {
        $this->uuidValid = null;
    }

    public function testThrowAnExceptionWhenValueIsNotValidUuid()
    {
        $this->expectException(\InvalidArgumentException::class);

        Uuid::fromString('fake_uuid');
    }

    public function testItImplementStringableInterface()
    {
        $uuid = Uuid::fromString($this->uuidValid);
        $this->assertInstanceOf(\Stringable::class, $uuid);
    }

    public function testItCanBeCreatedByValidString()
    {
        $uuid = Uuid::fromString($this->uuidValid);

        $this->assertInstanceOf(Uuid::class, $uuid);
        $this->assertIsString((string)$uuid);
    }
}
