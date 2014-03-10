<?php
namespace Album\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\ServiceManager\ServiceLocatorInterface;

use Album\Model\Album;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class AlbumTableGateway implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
		$resultSetPrototype = new ResultSet();
		$resultSetPrototype->setArrayObjectPrototype(new Album());
		return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
    }
}
