<?php
namespace Jtg\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jtg\Models\Property;
use Jtg\Connectors\Connector;

final class ListProperties extends Command {
    /**
     * Add in the command, setup details and arguments
     */
    protected function configure() {
        $this->setName('all');
        $this->setDescription('Shows a list of all properties in the DB');
    }

    /**
     * This is where the magic happens
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        // Hop on over to the Connector and hit up Doctrine for the DB connection
        $entityManager = Connector::connect();
        // Fetch the DB
    	$propertyRepository = $entityManager->getRepository('Jtg\Models\Property');
        // Grab Properties matching the query findAll()
        $properties = $propertyRepository->findAll();

        // Something there
        if ($properties) {
            foreach ($properties as $property) {
                // echo sprintf("** ID %s -- Name - %s -- Address - %s -- Price - %s -- Status - %s -- Bedrooms - %s\n",
                //     $property->getId(),
                //     $property->getName(),
                //     $property->getAddress(),
                //     $property->getPrice(),
                //     $property->getStatus(),
                //     $property->getBedrooms()
                // );

                print_r($property);
            }
        // Nothing there
        } else {
            echo sprintf("\n\n
                Ooops, seems like there are no properties in the DB yet!
                \n
                Try using the command create_property <name> <address> <price> <status> <bedrooms>
                \n\n");
        }
    }
}
