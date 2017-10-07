<?php
namespace Jtg\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jtg\Models\Property;
use Jtg\Connectors\Connector;

final class SearchProperties extends Command {
    /**
     * Add in the command, setup details and arguments
     */
    protected function configure() {
        $this->setName('search');
        $this->setDescription('Search for Properties by Status / Price / Bedrooms');
        $this->addArgument('status', InputArgument::REQUIRED, 'Search by Status');
        $this->addOption('price', 'p', InputOption::VALUE_OPTIONAL, 'Search by Price');
        $this->addOption('bedrooms', 'b', InputOption::VALUE_OPTIONAL, 'Search by Bedrooms');
    }

    /**
     * This is where the magic happens
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        // Hop on over to the Connector and hit up Doctrine for the DB connection
        $entityManager = Connector::connect();

        // Setup intput vars
        $status = $input->getArgument('status');
        $price = $input->getOption('price');
        $bedrooms = $input->getOption('bedrooms');

        // Grab the DB
        $propertyRepository = $entityManager->getRepository('Jtg\Models\Property');

        // Perform the query
        $query = $propertyRepository->createQueryBuilder('p')
                ->where('p.status = :status')
                ->setParameter('status', $status);
            if ($price !== null) {
                $query->andWhere('p.price <= :price')
                ->setParameter('price', $price);
            }
            if ($bedrooms !== null) {
                $query->andWhere('p.bedrooms <= :bedrooms')
                ->setParameter('bedrooms', $bedrooms);
            }
        $final_query = $query->getQuery();
        // Fetch the results
        $properties = $final_query->getResult();

        // If they exist
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
        // Nothing matching query
        } else {
            echo "No results to display, try a different query.\n";
            exit(1);
        }
    }
}
