<?php
namespace Jtg\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jtg\Models\Property;
use Jtg\Connectors\Connector;

final class CreateProperty extends Command {
    /**
     * Add in the command, setup details and arguments
     */
    protected function configure() {
        $this->setName('create');
        $this->setDescription('Stores a property in to an SQLite DB.');
        $this->addArgument('name', InputArgument::REQUIRED, 'Name of the property');
        $this->addArgument('status', InputArgument::REQUIRED, 'for-rent / for-sale');
        $this->addArgument('price', InputArgument::REQUIRED, 'Price, decimal value such as 120000 for one hundred and twenty thousand');
        $this->addOption('address', 'a', InputOption::VALUE_OPTIONAL, 'Address, this is comma separated for now!');
        $this->addOption('bedrooms', 'b', InputOption::VALUE_OPTIONAL, 'Number of bedrooms');
    }

    /**
     * This is where the magic happens
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
    	// Create a new Property Object
		$property = new Property();

		// Required
		$property->setName($input->getArgument('name'));
		$property->setStatus($input->getArgument('status'));
		$property->setPrice($input->getArgument('price'));

		// Not so required
		if ($input->getOption('address') !== null) {
			$property->setAddress($input->getOption('address'));
		}

		if ($input->getOption('bedrooms') !== null) {
			$property->setBedrooms($input->getOption('bedrooms'));
		}

		// Hop on over to the Connector and hit up Doctrine for the DB connection
		$entityManager = Connector::connect();

		// This is where we write to the DB
		$entityManager->persist($property);

		// Clean up
		$entityManager->flush();

		// Give a response to the user
        $output->writeln(sprintf(
            "Created Property with ID " . $property->getId() . "\n"
        ));

        // 0 = success, other values = fail
        return 0;
    }
}
