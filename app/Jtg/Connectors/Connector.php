<?php
namespace Jtg\Connectors;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class Connector {

	public static function connect() {
		// Default Doctrine config
		$isDevMode = true;
		// Doctrine autoloading
		$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../../app"), $isDevMode);

		// The DB settings
		$conn = array(
		    'driver' => 'pdo_sqlite',
		    'path' => __DIR__ . '/../../../storage/db.sqlite',
		);

		// Setup and return the entity manager
		return EntityManager::create($conn, $config);
	}
}
