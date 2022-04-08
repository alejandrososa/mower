<?php

namespace Kata\Domain\Collection;

abstract class AbstractCollection implements \IteratorAggregate, \Countable
{
    protected array $elements = [];

    public static function fromArray(array $elements): static
    {
        $self = new static();
        foreach ($elements as $element) {
            $self->append($element);
        }

        return $self;
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function append(mixed $element): void
    {
        $this->elements[] = $element;
    }

    public function count(): int
    {
        return count($this->elements);
    }
}
