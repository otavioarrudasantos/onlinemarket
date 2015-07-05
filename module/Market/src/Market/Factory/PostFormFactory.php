<?php
namespace Market\Factory;

use Market\Form\PostForm;
use Market\Model\WordCityAreaCodesTable;
use Zend\ServiceManager\FactoryInterface;

use Zend\ServiceManager\ServiceLocatorInterface;
class PostFormFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $sm) {

        $categories = $sm->get('categories');
        $cityCodesTable = $sm->get('city-codes-table');
        $codes = $cityCodesTable->getCodesForForm();

        $form = new PostForm();

        $form->setCategories($categories);

        $form->setCaptchaOptions($sm->get('market-captcha-options'));

        $form->setExpireDays($sm->get('market-expire-days'));

        $form->setInputFilter($sm->get('market-post-filter'));

        $form->setCityCodes($codes);

        $form->buildForm();


        return $form;
    }
}