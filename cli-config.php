<?php

require 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\ORMSetup;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new PhpFile('migrations.php');

$connectionParams = [
    'dbname' => $_ENV['DB_NAME'] ?? 'mydb',
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
];
$metaConfig = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__."/app/Entity"),
    isDevMode: true,
);
$connection = DriverManager::getConnection($connectionParams, $metaConfig);

$entityManager = new EntityManager($connection, $metaConfig);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));

