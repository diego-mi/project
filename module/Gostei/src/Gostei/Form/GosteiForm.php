<?php
namespace Gostei\Form;

use Zend\Form\Form;
use Post\Form\GosteiFilter;

class GosteiForm extends Form
{

    public function __construct()
    {

        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new GosteiFilter());

        $this->add(array(
            'name' => 'userid',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'postid',
            'type' => 'hidden',
        ));
    }
}
