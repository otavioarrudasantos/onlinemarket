<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/22/15
 * Time: 7:21 PM
 */

namespace Market\Factory;

use Market\Model\WordCityAreaCodesTable;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class WorldCityAreaCodesTableFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $sm)
    {
        return new WordCityAreaCodesTable(WordCityAreaCodesTable::$tableName, $sm->get('general-adapter'));
    }

}