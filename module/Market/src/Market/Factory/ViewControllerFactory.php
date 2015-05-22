<?php
namespace Market\Factory;

use Zend\ServiceManager\FactoryInterface;
use Market\Controller\ViewController;
use Zend\ServiceManager\ServiceLocatorInterface;
class ViewControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $controllerManager) {
        $allServices = $controllerManager->getServiceLocator();

        $sm = $allServices->get('ServiceManager');

        $viewController = new ViewController();

        $viewController->setListingsTable($sm->get('listings-table'));
        return $viewController;
    }
}