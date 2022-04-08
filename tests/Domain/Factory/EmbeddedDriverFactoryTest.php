<?php

namespace Kata\Tests\Domain\Factory;

use Kata\Domain\Driver\Driver;
use Kata\Domain\Factory\EmbeddedDriverFactory;
use PHPUnit\Framework\TestCase;

class EmbeddedDriverFactoryTest extends TestCase
{
    private ?Driver $sut = null;

    protected function setUp(): void
    {
        $this->sut = EmbeddedDriverFactory::create();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanCreateAEmbeddedDriver()
    {
        $this->assertInstanceOf(Driver::class, $this->sut);
    }
}
