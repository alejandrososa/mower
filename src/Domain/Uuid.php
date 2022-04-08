<?php

declare(strict_types=1);

namespace Kata\Domain;

use InvalidArgumentException;
use Stringable;
use Symfony\Component\Uid\Uuid as ComponentUuid;

class Uuid implements Stringable
{
    private function __construct(protected string $value)
    {
        $this->guardIsValidUuid($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): static
    {
        return new static(ComponentUuid::fromString($value)->toRfc4122());
    }

    public static function random(): self
    {
        return new self(ComponentUuid::v4()->toRfc4122());
    }

    private function guardIsValidUuid(string $id): void
    {
        if (!ComponentUuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}
