<?php
/**
 * Created by PhpStorm.
 * User: otavio
 * Date: 5/16/15
 * Time: 5:38 PM
 */

namespace Market\Form;


use Zend\Captcha\Image as ImageCaptcha;
use Zend\Form\Element\Captcha;
use Zend\Form\Element\Email;
use Zend\Form\Element\Number;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Url;
use Zend\Form\Form;

class PostForm extends Form{


    use ExpireDaysTrait;
    use CaptchaTrait;
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
                ->setAttributes([
                    'size'=> 60,
                    'maxLength'=>128,
                    'required' => 'required',
                    'placeholder' => 'Listing header',
                ]);

        $price = new Text('price');
        $price->setLabel('Price')
            ->setAttributes([
                'title' => 'Enter price as nnn.nn',
                'size' => 16,
                'maxlength' => 16,
                'placeholder' => 'Enter some value',
            ]);

        $dateExpires = new Radio('date_expires');
        $dateExpires->setLabel('Expires')
            ->setAttributes([
                'title' => 'The expiration date will be calculated from today',
                'class' => 'expiressButton'
            ])
            ->setValueOptions($this->getExpireDays());

        $description = new Textarea('description');
        $description->setLabel('Description')
            ->setAttributes([
               'title' => 'Enter a suitable description for this posting',
                'rows' => 5,
                'cols' => 80,
            ]);

        $photoFilename = new Url('photo_filename');
        $photoFilename->setLabel('Photo Filename')
            ->setAttributes([
                'maxlength' => 1024,
                'placeholder' => 'Enter URL of a JPG',
            ]);

        $contactName = new Text('contact_name');
        $contactName->setLabel('Contact Name')
            ->setAttributes([
               'title' => 'Enter the name of person to contact for this item',
                'size' => 40,
                'maxlength' => 255,
            ]);

        $contactEmail = new Email('contact_email');
        $contactEmail->setLabel('Contact Email')
            ->setAttributes([
                'title' => 'Enter the email of person to contact for this item',
                'size' => 40,
                'maxlength' => 255,
            ]);

        $contactPhone = new Text('contact_phone');
        $contactPhone->setLabel('Contact Phone')
            ->setAttributes([
                'title' => 'Enter the email of person to contact for this item',
                'size' => 40,
                'maxlength' => 255
            ]);

        $cityCode = new Select('city_code');
        $cityCode->setLabel('Nearest City')
            ->setAttributes([
               'title' => 'Select the city of the item',
                'id' => 'city_code',
                'placeholder' => 'Start typing and choose the city',
            ]);

        $deleteCode = new Number('delete_code');
        $deleteCode->setLabel('Delete Code')
            ->setAttributes([
               'title' => 'Enter the delete code of this item',
                'size' => 16,
                'maxlength' => 16,
            ]);

        $captcha = new Captcha('captcha');
        $captchaAdapter = new ImageCaptcha();
        $captchaAdapter->setWordlen(4)
            ->setOptions($this->captchaOptions);
        $captcha->setCaptcha($captchaAdapter)
            ->setLabel('Help us prevent SPAM!')
            ->setAttributes([
                'class' => 'captchaStyle',
                'title' => 'Help us prevent SPAM!',
            ]);

        $submit = new Submit('submit');
        $submit->setAttribute('value', 'post');

        $this->add($category)
            ->add($title)
            ->add($price)
            ->add($dateExpires)
            ->add($description)
            ->add($photoFilename)
            ->add($contactName)
            ->add($contactPhone)
            ->add($contactEmail)
            ->add($cityCode)
            ->add($deleteCode)
            ->add($captcha)
            ->add($submit);

        return $this;

    }
}