<?php

namespace Kata\Infrastructure\Bus;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class BusComponent
{
    private ?MessageBusInterface $bus = null;

    public function __construct()
    {
        $this->bus = BusFactory::create();
    }

    public function dispatch(mixed $dto): mixed
    {
        $envelope = $this->bus->dispatch($dto);
        $handledStamp = $envelope->last(HandledStamp::class);
        return $handledStamp->getResult();
    }
}
