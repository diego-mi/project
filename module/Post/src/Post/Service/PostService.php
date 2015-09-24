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


}