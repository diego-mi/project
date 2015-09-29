<?php
namespace Gostei\Form;

use Zend\InputFilter\InputFilter;

class GosteiFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'userid',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name' => 'postid',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));


    }
}
