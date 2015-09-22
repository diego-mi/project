<?php
namespace Post\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

use Post\Form\PostFilter;

class PostForm extends Form
{
    protected $objectManager;

    public function __construct()
    {

        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'type',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'authorId',
            'type' => 'Hidden',
            'value'=> 1,
        ));

        $this->add(array(
            'name' => 'content',
            'type' => 'Text',
            'options' => array(
                'label' => 'Content',
            ),
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