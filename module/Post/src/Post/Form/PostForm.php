<?php
namespace Post\Form;

use Zend\Form\Form;
use Post\Form\PostFilter;

class PostForm extends Form
{

    public function __construct()
    {

        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');
        $this->setInputFilter(new PostFilter());

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'type',
            'type' => 'Hidden',
            'value' => '1',
            'attributes' => array(
                'value' => '1',
            ),
        ));


        $this->add(array(
            'name' => 'content',
            'type' => 'textarea',
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'classification',
            'options' => array(
                'label' => 'Classification',
                'value_options' => array(
                    '1' => 'Free',
                    '2' => 'Adult',
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'privacity',
            'options' => array(
                'label' => 'Privacity',
                'value_options' => array(
                    '1' => 'Public',
                    '2' => 'Friends',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'picture',
            'type' => 'file',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Postar',
                'id' => 'submitbutton',
            ),
        ));
    }
}
