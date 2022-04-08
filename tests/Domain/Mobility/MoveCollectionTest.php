<?php

namespace Kata\Tests\Domain\Mobility;

use Kata\Domain\Mobility\{MoveCollection,
    SpinLeftMove,
    SpinRightMove,
    StepForwardMove
};
use PHPUnit\Framework\TestCase;

class MoveCollectionTest extends TestCase
{
    private ?MoveCollection $sut = null;

    protected function setUp(): void
    {
        $this->sut = new MoveCollection();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanIteratorOverCollection()
    {
        $this->sut->append(new SpinLeftMove());
        $this->sut->append(new SpinRightMove());
        $this->sut->append(new StepForwardMove());

        $moves = [];
        foreach ($this->sut->getIterator() as $move) {
            $moves[] = $move->getType();
        }

        $expected = [
            (new SpinLeftMove)->getType(),
            (new SpinRightMove)->getType(),
            (new StepForwardMove)->getType(),
        ];

        $this->assertSame($expected, $moves);
    }

    public function testItCanAddMove()
    {
        $this->sut->append(new SpinLeftMove());
        $this->sut->append(new SpinRightMove());

        $this->assertCount(2, $this->sut);
    }
}
