<?php

namespace Kata\Application;

use Kata\Domain\Factory\{GridFactory, RoverFactory};
use Kata\Domain\{Grid, Rover, Uuid};
use Kata\Domain\Input\LineCollection;
use Kata\Domain\Navigation\Instruction;

class GridControllerHandler
{
    public const START_POSITION = 0;

    private ?Grid $grid = null;
    private array $roverMap = [];

    public function __invoke(GridController $command): Grid
    {
        $lineCollection = LineCollection::fromArray($command->getLines());

        $this->arrangeGridWithRovers($lineCollection);
        $this->moveRoversInTheGrid($lineCollection);

        return $this->grid;
    }

    private function arrangeGridWithRovers(LineCollection $lineCollection): void
    {
        foreach ($lineCollection->getIterator() as $position => $line) {
            //create grid
            if ($position === self::START_POSITION) {
                $this->createGridFromString($line);
            }

            //create rovers
            if ($position !== self::START_POSITION && $this->isFirstLineOfRover($position)) {
                $rover = $this->createRoverFromString($line);
                $this->grid->addRover($rover);

                $this->roverMap[$position] = (string)$rover->getId();
            }
        }
    }

    private function moveRoversInTheGrid(LineCollection $lineCollection)
    {
        foreach ($lineCollection->getIterator() as $position => $line) {
            //move rovers
            if ($position !== self::START_POSITION && !$this->isFirstLineOfRover($position)) {
                $roverId = $this->roverMap[$position - 1] ?? null;

                if (empty($roverId)) {
                    continue;
                }

                $this->grid->sendInstructionsToRover(
                    id: Uuid::fromString($roverId),
                    instruction: new Instruction($line)
                );
            }
        }
    }

    private function createGridFromString(string $coordinates): void
    {
        [$coordinateX, $coordinateY] = $this->convertStringToArray($coordinates);

        $this->grid = GridFactory::create(
            coordinateX: $coordinateX,
            coordinateY: $coordinateY,
        );
    }

    private function createRoverFromString(string $location): Rover
    {
        [$coordinateX, $coordinateY, $orientation] = $this->convertStringToArray($location);

        $rover = RoverFactory::create(
            coordinateX: $coordinateX,
            coordinateY: $coordinateY,
            orientation: $orientation
        );

        return $rover;
    }


    private function convertStringToArray(string $data): array
    {
        return str_split(preg_replace('/\s+/', '', $data));
    }

    private function isFirstLineOfRover(mixed $position): bool
    {
        return $position % 2 !== 0;
    }
}
