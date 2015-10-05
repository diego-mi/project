<?php

namespace Register\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class RegisterForm extends Form
{
    /**
     *
     */
    public function prepareElements()
    {
        parent::__construct('register', array());
        $this->setAttribute('method', 'POST');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Username',
            ),
            'type' => 'Text',
        ));

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Name',
            ),
            'type' => 'Text',
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'type' => 'Email',
        ));

        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'type' => 'Password',
        ));

        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'value' => 'Register',
            ),
        ));

    }
}
