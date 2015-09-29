<?php
namespace Gostei\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class GosteiService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Gostei\Entity\Gostei';
        parent::__construct($em);
    }

    /**
     * @param array $data
     *
     * @param int $userId
     *
     * @return object
     */
    public function insert($data)
    {
        $entity = new $this->entity($data);
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}