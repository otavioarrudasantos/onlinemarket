<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/17/15
 * Time: 2:34 PM
 */

namespace Market\Factory;


use Market\Form\PostFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostFilterFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $sm){

        $filter = new PostFilter();
        $filter->setCategories($sm->get('categories'));
        $filter->setExpireDays($sm->get('market-expire-days'));
        $filter->buildFilter();
        return $filter;
    }
}