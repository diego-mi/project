<?php
namespace Profile\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class ProfileService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Profile\Entity\Profile';
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
    public function save($data)
    {
        return parent::save($data);
    }

}