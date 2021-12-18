<?php

use Riandziuba\Effecti\helper\entityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
// require_once 'bootstrap.php';
require_once __DIR__ . '/vendor/autoload.php';

// replace with mechanism to retrieve EntityManager in your app
//$entityManager = GetEntityManager();

$entityManagerFactory = new entityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);

// execute no terminal os comandos vendor\bin\doctrine
// vendor/bin/doctrine list
// vendor/bin/doctrine orm:info
// vendor/bin/doctrine orm:mapping:describe Curso
// entityName Curso
// CRIAR TABELAS MAPEADAS DAS CLASSES
// vendor/bin/doctrine orm:schema-tool:create
