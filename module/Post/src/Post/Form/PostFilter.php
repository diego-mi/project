<?php
namespace Post\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\InArray;
use Zend\Validator\NotEmpty;

class PostFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name'     => 'id',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));
        $this->add(array(
            'name'     => 'type',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));
        $this->add(array(
            'name'     => 'author_id',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name'     => 'content',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 100,
                    ),
                ),
            ),
        ));

    }
}
