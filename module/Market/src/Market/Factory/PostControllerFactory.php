<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Market\Controller\PostController;
use Zend\ServiceManager\ServiceLocatorInterface;
class PostControllerFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $controllerManager) {
        $allServices = $controllerManager->getServiceLocator();
        
        $sm = $allServices->get('ServiceManager');
        
        $categories = $sm->get('categories');
        $cityCodes = $sm->get('city-codes-table');
        $postController = new PostController();
        $postController->setCategories($categories);
        $postController->setCityCodeTable($cityCodes);
        $postController->setPostForm($sm->get('market-post-form'));
        $postController->setListingsTable($sm->get('listings-table'));
        return $postController;
    }
}