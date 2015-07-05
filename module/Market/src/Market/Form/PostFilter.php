<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/17/15
 * Time: 1:58 PM
 */

namespace Market\Form;


use Market\Form\Filter\Float;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Regex;

class PostFilter extends InputFilter {
    use ExpireDaysTrait;

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
        $category->setErrorMessage('Invalid category');
        $category->getFilterChain()
            ->attachByName('StringTrim')
            ->attachByName('StripTags')
            ->attachByName('StringToLower');

        $category->getValidatorChain()
                ->attachByName('InArray', array('haystack'=>$this->categories));

        $title = new Input('title');
        $title->setErrorMessage('Invalid title');
        $title->getFilterChain()
                ->attachByName('StringTrim')
                ->attachByName('StripTags');

        $titleRegex = new Regex(array('pattern' => '/^[a-zA-Z0-9]*$/'));
        $titleRegex->setMessage('Title should contain numbers, letters or spaces');
        $title->getValidatorChain()
                ->attach($titleRegex)
                ->attachByName('StringLength', array('min' => 1, 'max'=>128));

        $price = new Input('price');
        $price->setErrorMessage('Invalid price');
        $price->setAllowEmpty(true);
        $price->getValidatorChain()->attachByName('GreaterThan', array('min'=>0.000));
        $price->getFilterChain()->attach(new Float());

        $dateExpires = new Input('date_expires');
        $dateExpires->setErrorMessage('Invalid expire date');
        $dateExpires->setAllowEmpty(true);
        $dateExpires->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');

        $description = new Input('description');
        $description->setErrorMessage('Invalid description');
        $description->setAllowEmpty(true);
        $description->getValidatorChain()->attachByName('StringLength', array('min' => 1, 'max'=> 4096));
        $description->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');

        $photoFilename = new Input('photo_filename');
        $photoFilename->setAllowEmpty(true);
        $photoFilename->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        $photoFilename->getValidatorChain()
            ->attachByName('Regex', array('pattern' => '!^(http://)?[a-z0-9./_-]+(jp(e)?g|png)$!i'));
        $photoFilename->setErrorMessage('Photo must be a URL or a valid filename ending with jpg or png');

        $contactName = new Input('contact_name');
        $contactName->setErrorMessage('Invalid contact name');
        $contactName->setAllowEmpty(TRUE);
        $contactName->getValidatorChain()
            ->attachByName('Regex', array('pattern' => '/^[a-z0-9., -]{1,255}$/i'));
        $contactName->setErrorMessage('Name should only contain letters, numbers, and some punctuation.');
        $contactName->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');

        $contactEmail = new Input('contact_email');
        $contactEmail->setErrorMessage('Invalid email');
        $contactEmail->setAllowEmpty(TRUE);
        $contactEmail->getValidatorChain()
            ->attachByName('EmailAddress');
        $contactEmail->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');

        $contactPhone = new Input('contact_phone');
        $contactPhone->setErrorMessage('Invalid category');
        $contactPhone->setAllowEmpty(TRUE);
        $contactPhone->getValidatorChain()
            ->attachByName('Regex', array('pattern' => '/^\+?\d{1,4}(-\d{3,4})+$/'));
        $contactPhone->setErrorMessage('Phone number must be in this format: +nnnn-nnn-nnn-nnnn');
        $contactPhone->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');

        $cityCode = new Input('city_code');
        $cityCode->setErrorMessage('Invalid category');
        $cityCode->setAllowEmpty(true);
        $cityCode->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');

        $deleteCode = new Input('delete_code');
        $deleteCode->setErrorMessage('Invalid category');
        $deleteCode->setRequired(TRUE);
        $deleteCode->getValidatorChain()
            ->attachByName('Digits');

        $this->add($category)
            ->add($title)
            ->add($price)
            ->add($dateExpires)
            ->add($description)
            ->add($photoFilename)
            ->add($contactName)
            ->add($contactEmail)
            ->add($contactPhone)
            ->add($cityCode)
            ->add($deleteCode);
    }
}