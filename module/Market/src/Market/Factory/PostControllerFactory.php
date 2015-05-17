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
        
        $postController = new PostController();
        $postController->setCategories($categories);

        $postController->setPostForm($sm->get('market-post-form'));

        return $postController;
    }
}