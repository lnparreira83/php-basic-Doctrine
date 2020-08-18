<?php


namespace Alura\Doctrine\Helper;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    /**
     * @return EntityManagerInterface
     * @throws ORMException
     */
    public function getEntityManager():EntityManagerInterface
    {
        $rootDir = __DIR__.'/..';
        $config = Setup::createAnnotationMetadataConfiguration([$rootDir],
            true
        );
        $connection = [
            'driver'=>'pdo_sqlite',
            'path'=>$rootDir . '/var/data/banco.sqlite'
        ];
        return EntityManager::create($connection, $config);
    }

}