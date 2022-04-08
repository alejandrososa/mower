<?php

namespace Kata\Infrastructure\Bus;

use Kata\Application\GridController;
use Kata\Application\GridControllerHandler;
use Kata\Application\ReadInstructionsFromResources;
use Kata\Application\ReadInstructionsFromResourcesHandler;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class BusFactory
{
    public static function create(): MessageBusInterface
    {
        $bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator([
                GridController::class => [new GridControllerHandler()],
                ReadInstructionsFromResources::class => [new ReadInstructionsFromResourcesHandler()],
            ])),
        ]);

        return $bus;
    }
}
