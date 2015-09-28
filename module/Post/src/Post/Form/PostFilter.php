<?php
namespace Post\Form;

use Zend\InputFilter\InputFilter;

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
            'name' => 'content',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
            ),
        ));


        $this->add(
            array(
                'name' => 'picture',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Zend\Validator\File\MimeType',
                        'options' => array(
                            'mimeType' => 'image'
                        )
                    )
                ),
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\File\RenameUpload',
                        'options' => array(
                            'target' => './public/upload/posts/img',
                            'randomize' => true,
                            'use_upload_extension' => true
                        )
                    )
                )
            )
        );

    }
}
