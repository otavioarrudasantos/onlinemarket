<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController{
    use ListingsTableTrait;

    public function indexAction(){
        $category = $this->params()->fromRoute('category');

        if(empty($category)){
            return new ViewModel([]);
        }

        $listingsTable = $this->getListingsTable();

        $listings = $listingsTable->getListingsByCategory($category);
        return new ViewModel(['category' => $category, 'listings' => $listings]);
    }    

    public function itemAction() {
        $itemId = $this->params()->fromRoute('itemId');

        $item = $this->getListingsTable()->getListingsById($itemId);

        if(empty($itemId) || empty($item)){
            $this->flashMessenger()->addMessage('Item Not Found');
            return $this->redirect()->toRoute('market');
        }


        return new ViewModel(['itemId' => $itemId, 'item' => $item]);
    }
}