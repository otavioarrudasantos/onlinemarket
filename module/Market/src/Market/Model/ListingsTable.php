<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/21/15
 * Time: 5:13 PM
 */

namespace Market\Model;


use Zend\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway{
    public static $tableName = 'listings';
}