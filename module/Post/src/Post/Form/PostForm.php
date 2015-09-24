<?php
namespace Post\Form;

use Zend\Form\Form;
use Post\Form\PostForm;

class PostForm extends Form
{
    protected $objectManager;

    public function __construct()
    {

        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('enctype', 'multipart/form-data');
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
            'name' => 'authorId',
            'type' => 'Hidden',
            'attributes' => array(
                'value' => '1',
            ),
        ));

        $this->add(array(
            'name' => 'content',
            'type' => 'Text',
            'options' => array(
                'label' => 'Content',
            ),
        ));

        $this->add(array(
            'name' => 'classification',
            'type' => 'Text',
            'options' => array(
                'label' => 'Classification',
            ),
        ));

        $this->add(array(
            'name' => 'privacity',
            'type' => 'Text',
            'options' => array(
                'label' => 'Privacity',
            ),
        ));

        $this->add(array(
            'name' => 'privacity',
            'type' => 'Text',
            'options' => array(
                'label' => 'Privacity',
            ),
        ));

        $arquivo = new File('arquivo');
        $arquivo->setLabel('Foto');
        $this->add($arquivo);

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