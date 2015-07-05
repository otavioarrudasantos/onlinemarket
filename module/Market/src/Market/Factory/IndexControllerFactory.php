<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Market\Controller\IndexController;
use Zend\ServiceManager\ServiceLocatorInterface;
class IndexControllerFactory implements FactoryInterface {
    
    public function createService(ServiceLocatorInterface $controllerManager) {
        $allServices = $controllerManager->getServiceLocator();
        
        $sm = $allServices->get('ServiceManager');

        $indexController = new IndexController();

        $indexController->setListingsTable($sm->get('listings-table'));
        return $indexController;
    }
}