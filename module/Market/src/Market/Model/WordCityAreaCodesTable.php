<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/22/15
 * Time: 7:09 PM
 */

namespace Market\Model;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class WordCityAreaCodesTable extends TableGateway {

    public static $tableName = 'world_city_area_codes';

    public function getCodesForForm(){
        $codesForForm = [];
        $data = $this->select();
        if($data instanceof ResultSet){

            while($item = $data->current()){

                $codesForForm[$item->world_city_area_code_id] = $item->city ;
                $data->next();
            }
        }

        return $codesForForm;
    }

    public function getCodeById($id){
        return $this->select(['world_city_area_code_id' => $id])->current();
    }
}