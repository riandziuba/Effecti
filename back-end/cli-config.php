<?php

use Riandziuba\Effecti\helper\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
// require_once 'bootstrap.php';
require_once __DIR__ . '/vendor/autoload.php';

// replace with mechanism to retrieve EntityManager in your app
//$entityManager = GetEntityManager();

$EntityManagerFactory = new EntityManagerFactory();
$entityManager = $EntityManagerFactory->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

// execute no terminal os comandos vendor\bin\doctrine
// vendor/bin/doctrine list
// vendor/bin/doctrine orm:info
// vendor/bin/doctrine orm:mapping:describe Curso
// entityName Curso
// CRIAR TABELAS MAPEADAS DAS CLASSES
// vendor/bin/doctrine orm:schema-tool:create
