<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/21/15
 * Time: 6:02 PM
 */

namespace Market\Controller;


trait ListingsTableTrait {
    private $listingsTable;

    /**
     * @return mixed
     */
    public function getListingsTable()
    {
        return $this->listingsTable;
    }

    /**
     * @param mixed $listingsTable
     */
    public function setListingsTable($listingsTable)
    {
        $this->listingsTable = $listingsTable;
    }



}