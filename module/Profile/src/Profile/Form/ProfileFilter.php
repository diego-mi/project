<?php
namespace Profile\Form;

use Zend\InputFilter\InputFilter;

class ProfileFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'id',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));

        $this->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
            ),
        ));


        $this->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
            ),
        ));


        $this->add(array(
            'name' => 'email',
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
                            'target' => './public/upload/profile/img',
                            'randomize' => true,
                            'use_upload_extension' => true
                        )
                    )
                )
            )
        );

    }
}
