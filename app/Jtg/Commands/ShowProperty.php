<?php
namespace Jtg\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jtg\Models\Property;
use Jtg\Connectors\Connector;

final class ShowProperty extends Command {
    /**
     * Add in the command, setup details and arguments
     */
    protected function configure() {
        $this->setName('show');
        $this->setDescription('Find a property by its ID');
        $this->addArgument('id', InputArgument::REQUIRED, 'ID must be set');
    }

    /**
     * This is where the magic happens
     */
    protected function execute(InputInterface $input, OutputInterface $output) {

        $id = $input->getArgument('id');

        // Hop on over to the Connector and hit up Doctrine for the DB connection
        $entityManager = Connector::connect();
        // Fetch the DB
        $propertyRepository = $entityManager->getRepository('Jtg\Models\Property');
        // Grab Properties matching the query findAll()
        $property = $propertyRepository->findOneBy(array( 'id' => $id));




        // If its not there
        if ($property === null) {
            echo "Property not found, please try an different ID.\n";
            exit(1);
        }
        // If it is there
        // echo sprintf(
        //     "** ID %s -- %s -- %s -- %s -- %s\n",
        //     $property->getId(),
        //     $property->getName(),
        //     $property->getAddress(),
        //     $property->getPrice(),
        //     $property->getStatus()
        // );

        print_r($property);
    }
}
