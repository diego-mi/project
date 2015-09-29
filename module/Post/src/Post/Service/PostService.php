<?php
namespace Post\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class PostService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Post\Entity\Post';
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
        $data['authorId'] = $userId;

        return parent::save($data);
    }

    /**
     * @param array $data
     *
     * @param int $userId
     * @param array $data
     *
     * @return object
     */
    public function insert($data, $userId)
    {
        $data['authorId'] = $userId;
        if ((count($data['picture'])) && (!empty($data['picture']['tmp_name'])) ) {
            $data['picture'] = $this->getNewNameFileUpload($data['picture']['tmp_name']);
        } else {
            uset($data['picture']);
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