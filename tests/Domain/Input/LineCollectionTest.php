<?php

namespace Kata\Tests\Domain\Input;

use Kata\Domain\Input\LineCollection;
use PHPUnit\Framework\TestCase;

class LineCollectionTest extends TestCase
{
    private ?LineCollection $sut = null;

    protected function setUp(): void
    {
        $this->sut = new LineCollection();
    }

    protected function tearDown(): void
    {
        $this->sut = null;
    }

    public function testItCanIteratorOverCollection()
    {
        $this->sut->append('5 5');
        $this->sut->append('1 2 N');
        $this->sut->append('LMLMLMLMM');
        $this->sut->append('3 3 E');
        $this->sut->append('MMRMMRMRRM');

        $lines = [];
        foreach ($this->sut->getIterator() as $line) {
            $lines[] = $line;
        }

        $expected = [
            '5 5',
            '1 2 N',
            'LMLMLMLMM',
            '3 3 E',
            'MMRMMRMRRM',
        ];

        $this->assertSame($expected, $lines);
    }

    public function testItCanAddMove()
    {
        $this->sut->append('5 5');
        $this->sut->append('1 2 N');
        $this->sut->append('LMLMLMLMM');

        $this->assertCount(3, $this->sut);
    }
}
