<?php

namespace Kata\Tests\Domain\Navigation;

use Kata\Domain\Navigation\{Location, Orientation};
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testItCannotFaceAnywhere()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Orientation('fake_orientation');
    }

    public function testItImplementStringableInterface()
    {
        $sut = new Location(
            coordinates: CoordinatesMother::create(),
            orientation: OrientationMother::create(),
        );
        $this->assertInstanceOf(\Stringable::class, $sut);
        $this->assertIsString((string)$sut);
    }
}
