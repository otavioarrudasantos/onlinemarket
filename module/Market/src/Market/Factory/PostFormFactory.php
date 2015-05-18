<?php
namespace Market\Factory;

use Market\Form\PostForm;
use Zend\ServiceManager\FactoryInterface;

use Zend\ServiceManager\ServiceLocatorInterface;
class PostFormFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $sm) {

        $categories = $sm->get('categories');

        $form = new PostForm();

        $form->setCategories($categories);

        $form->setCaptchaOptions($sm->get('market-captcha-options'));

        $form->setExpireDays($sm->get('market-expire-days'));

        $form->setInputFilter($sm->get('market-post-filter'));

        $form->buildForm();


        return $form;
    }
}