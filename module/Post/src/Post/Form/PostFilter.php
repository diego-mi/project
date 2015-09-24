<?php
namespace Post\Form;

use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\File\MimeType;

class PostFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'id',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));
        $this->add(array(
            'name' => 'type',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));
        $this->add(array(
            'name' => 'author_id',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name' => 'content',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));

        $arquivo = new FileInput('picture');
        $arquivo->setRequired(true);
        $arquivo->getFilterChain()->attach(
            array(
                'target' => '.data/blog_',
                'use_upload_extension' => true,
                'randomize' => true,
            )
        );

        $arquivo->getValidatorChain()->attach(
            array(
                'max' => substr(ini_get('upload_max_filesize'), 0, -1) . 'MB'
            )
        );

        $arquivo->getValidatorChain()->attach(
            new MimeType(
                array(
                    'image/gif',
                    'image/jpeg',
                    'image/png',
                    'enableheaderCheck' => true
                )
            )
        );

    }
}
