<?php

namespace Kata\Infrastructure\Ui\Console;

use Kata\Application\{GridController, ReadInstructionsFromResources};
use Kata\Infrastructure\Bus\BusComponent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EVControlCommand extends Command
{
    protected static $defaultName = 'kata:electronic-vehicle:move';
    protected static $defaultDescription = 'Send commands to move a electronic vehicle';

    public function __construct(private BusComponent $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $io->title('<info>ELECTRONIC VEHICLE</info>');
            $io->info('Reading the instructions...');
            $input = $this->bus->dispatch(new ReadInstructionsFromResources());

            $io->info('Creating the grid area and Send the instructions to all rovers...');
            $grid = $this->bus->dispatch(new GridController($input));

            $io->title('<info>OUTPUT</info>');
            $io->text($grid->getLocationsOccupied());
            $io->newLine();

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
