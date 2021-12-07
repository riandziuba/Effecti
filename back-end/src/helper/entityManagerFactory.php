<?php
 namespace Riandziuba\Effecti\helper;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class entityManagerFactory
{
    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../..';
        $config = Setup::createAnnotationMetadataConfiguration([
            $rootDir . '/src'],
            true // modo Desenvolvimento
        );
        $connection = [
            'driver' => 'pdo_sqlite',
            'user' => '',
            'password' => '',
            'path' => $rootDir.'/DB/effecti.db'
        ];

        return EntityManager::create($connection, $config);
    }

}
