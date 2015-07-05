<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/21/15
 * Time: 5:51 PM
 */

namespace Market\Factory;


use Market\Model\ListingsTable;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListingsTableFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $sm)
    {
        return new ListingsTable(ListingsTable::$tableName, $sm->get('general-adapter'));

    }

}