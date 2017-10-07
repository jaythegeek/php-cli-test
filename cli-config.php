<?php

use Jtg\Connectors\Connector;

require_once __DIR__."/vendor/autoload.php";


	 // Hop on over to the Connector and hit up Doctrine for the DB connection
    $entityManager = Connector::connect();

	return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

