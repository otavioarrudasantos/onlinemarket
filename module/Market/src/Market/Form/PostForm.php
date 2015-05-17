<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/16/15
 * Time: 5:38 PM
 */

namespace Market\Form;


use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class PostForm extends Form{

    private $categories;

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function buildForm(){
        $this->setAttribute('method', 'POST');
        $category = new Select('category');
        $category->setLabel('Category')
                ->setValueOptions(
                    array_combine($this->categories, $this->categories)
                );
        $title = new Text('title');
        $title->setLabel('Title')
                ->setAttributes(['size'=> 60, 'maxLength'=>128]);
        $submit = new Submit('submit');
        $submit->setAttribute('value', 'post');

        $this->add($category)
            ->add($title)
            ->add($submit);
    }
}