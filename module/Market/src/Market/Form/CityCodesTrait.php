<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/22/15
 * Time: 7:33 PM
 */

namespace Market\Form;


trait CityCodesTrait {
    private $cityCodes;

    /**
     * @return mixed
     */
    public function getCityCodes()
    {
        return $this->cityCodes;
    }

    /**
     * @param mixed $cityCodes
     */
    public function setCityCodes(array $cityCodes)
    {
        $this->cityCodes = $cityCodes;
    }


}