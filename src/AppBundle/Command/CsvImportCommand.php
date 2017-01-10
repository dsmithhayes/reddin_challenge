<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CsvImportCommand extends ContainerAwareCommand
{
    /**
     * The sole argument for the command is the path to the CSV file.
     */
    protected function configure()
    {
        parent::configure();

        $this->setName('csv:import-users')
             ->addArgument('path', InputArgument::REQUIRED);
    }

    /**
     * Reads the CSV file and inputs each row into the database as a user. If
     * the file path given to the command doesn't exist, the Symfony console
     * handles relaying the error.
     */
    protected function execute(InputInterface $in, OutputInterface $out)
    {
        $fh = fopen($in->getArgument('path'), 'r');
    }
}
