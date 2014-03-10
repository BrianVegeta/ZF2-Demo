<?php
namespace Album\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Album\Model\AlbumTable;

class Album implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $tableGateway = $serviceLocator->get('album.table.gateway');
        $table = new AlbumTable($tableGateway);
        return $table;
    }
}
