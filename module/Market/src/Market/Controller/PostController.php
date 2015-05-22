<?php
namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class PostController extends AbstractActionController{
    use ListingsTableTrait;
    public $categories;

    private $postForm;

    /**
     * @return mixed
     */
    public function getPostForm()
    {
        return $this->postForm;
    }

    /**
     * @param mixed $postForm
     */
    public function setPostForm($postForm)
    {
        $this->postForm = $postForm;
    }

    public function setCategories($arrCategories){
        $this->categories = $arrCategories;
    }    

    public function indexAction(){

        $params = $this->params()->fromPost();
//        $this->postForm->setData($params);
        $viewModel = new ViewModel(['postForm'=> $this->postForm, 'data' => $params]);
        $viewModel->setTemplate('market/post/index.phtml');
        if($this->getRequest()->isPost()){
            $this->postForm->setData($params);
            if($this->postForm->isValid()){
                $this->flashMessenger()->addMessage('Thanks for posting');
                $this->redirect()->toRoute('home');
            }else{
                $invalidView = new ViewModel();
                $invalidView->setTemplate('market/post/invalid.phtml');
                $invalidView->addChild($viewModel,'main');
                return $invalidView;
            }
        }
        return $viewModel;

//        $viewModel->setTemplate('market/post/invalid.phtml');
        return $viewModel;
    }

}