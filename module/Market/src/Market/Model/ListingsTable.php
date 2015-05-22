<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/21/15
 * Time: 5:13 PM
 */

namespace Market\Model;


use Zend\Db\Adapter\Platform\Mysql;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway{
    public static $tableName = 'listings';

    public function getListingsByCategory($category){
        return  $this->select(['category' => $category]);
    }

    public function getListingsById($id){
        return  $this->select(['listings_id' => $id])->current();
    }
}