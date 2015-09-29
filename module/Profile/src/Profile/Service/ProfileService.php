<?php
namespace Profile\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class ProfileService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Post\Entity\User';
        parent::__construct($em);
    }

    /**
     * @param array $data
     *
     * @param int $userId
     * @param array $data
     *
     * @return object
     */
    public function save($data, $userId)
    {
        if (count($data['picture'])) {
            $data['picture'] = $this->getNewNameFileUpload($data['picture']['tmp_name']);
        }

        return parent::save($data);
    }

    /**
     * @param string $tmpName Nome temporario do arquivo que foi upado
     */
    protected function getNewNameFileUpload($tmpName)
    {
        $tmpNameFull = explode("_", $tmpName);
        return $tmpNameFull[1];
    }

}