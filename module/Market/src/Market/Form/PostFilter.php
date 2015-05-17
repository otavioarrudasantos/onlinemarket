<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/17/15
 * Time: 1:58 PM
 */

namespace Market\Form;


use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Regex;

class PostFilter extends InputFilter {
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

    public function buildFilter(){
        $category = new Input('category');
        $category->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags')
                ->attachByName('StringToLower');

        $category->getValidatorChain()
                ->attachByName('InArray', array('haystack'=>$this->categories));

        $title = new Input('title');
        $title->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        $titleRegex = new Regex(array('pattern' => '/^[a-zA-Z0-9]*$/'));
        $titleRegex->setMessage('Title should contain numbers, letters or spaces');
        $title->getValidatorChain()
                ->attach($titleRegex)
                ->attachByName('StringLength', array('min' => 1, 'max'=>128));

        $this->add($category);
        $this->add($title);



    }
}