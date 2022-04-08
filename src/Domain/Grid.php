<?php

namespace Kata\Domain;

use Kata\Domain\Navigation\{
    Coordinates,
    Instruction,
    Location
};

class Grid
{
    public const MIN_VALUE = 0;

    /** @var Rover[] */
    private array $rovers = [];

    public function __construct(private Coordinates $maxCoordinate)
    {
        $this->guardAreValidInstructions($maxCoordinate);
    }

    private function guardAreValidInstructions(Coordinates $coordinate): void
    {
        if ($coordinate->getX() <= self::MIN_VALUE || $coordinate->getY() <= self::MIN_VALUE) {
            $message = sprintf('Invalid area limit x = %d, y = %d', $coordinate->getX(), $coordinate->getY());
            throw new \InvalidArgumentException($message);
        }
    }

    public function getMinCoordinates(): Coordinates
    {
        return new Coordinates(self::MIN_VALUE, self::MIN_VALUE);
    }

    public function getMaxCoordinates(): Coordinates
    {
        return $this->maxCoordinate;
    }

    public function getLocationsOccupied(): array
    {
        $report = [];
        /** @var Rover $rover */
        foreach ($this->rovers as $rover) {
            $report[] = (string)$rover->getLocation();
        }

        return $report;
    }

    public function addRover(Rover $rover): self
    {
        $this->guardLocationIsAvailable($rover->getId(), $rover->getLocation());
        $this->guardHasNotExceededTheAvailableLimits($rover->getId(), $rover->getLocation());
        $this->rovers[(string)$rover->getId()] = $rover;

        return $this;
    }

    public function sendInstructionsToRover(Uuid $id, Instruction $instruction): void
    {
        $rover = $this->getRoverById($id);

        if (empty($rover)) {
            return;
        }

        $futureLocation = $rover->getFutureLocationBy($instruction);

        $this->guardLocationIsAvailable($rover->getId(), $futureLocation);

        $rover->move($instruction);

        $this->rovers[(string)$id] = $rover;
    }

    private function guardLocationIsAvailable(Uuid $id, Location $location): void
    {
        $spacesUsedByRovers = $this->getLocationsOccupied();
        $locationOfNewRover = (string)$location;

        if (true === in_array($locationOfNewRover, $spacesUsedByRovers, true)) {
            $message = sprintf(
                'Location \'%s\' is not available for rover id: %s',
                $locationOfNewRover,
                $id
            );
            throw new \InvalidArgumentException($message);
        }
    }

    private function guardHasNotExceededTheAvailableLimits(Uuid $id, Location $location): void
    {
        $maxCoordinates = $this->getMaxCoordinates();
        $minCoordinates = $this->getMinCoordinates();
        $coordinates = $location->getCoordinates();

        if ($coordinates->getX() > $maxCoordinates->getX() || $coordinates->getY() > $maxCoordinates->getY()) {
            $message = sprintf(
                'Coordinate \'%s\' outside the maximum limits \'%s\', for rover id: %s',
                $coordinates,
                $maxCoordinates,
                $id
            );
            throw new \InvalidArgumentException($message);
        }

        if ($minCoordinates->getX() > $coordinates->getX() || $minCoordinates->getY() > $coordinates->getY()) {
            $message = sprintf(
                'Coordinate \'%s\' outside the minimum limits \'%s\', for rover id: %s',
                $coordinates,
                $minCoordinates,
                $id
            );
            throw new \InvalidArgumentException($message);
        }
    }

    private function getRoverById(Uuid $id): ?Rover
    {
        return $this->rovers[(string)$id] ?? null;
    }
}
