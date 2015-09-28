<?php
namespace Profile\Form;

use Zend\Form\Form;
use Post\Form\PostFilter;

class ProfileForm extends Form
{

    public function __construct()
    {

        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');
        $this->setInputFilter(new ProfileFilter());

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'username',
            'type' => 'text',
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'text',
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'text',
        ));

        $this->add(array(
            'name' => 'picture',
            'type' => 'file',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => 'submitbutton',
            ),
        ));
    }
}
