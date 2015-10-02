<?php
namespace Comment\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class CommentService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Comment\Entity\Comment';
        parent::__construct($em);
    }

    /**
     * @param array $data
     *
     * @param int $userId
     *
     * @return object
     */
    public function comment($data)
    {
        $entity = new $this->entity($data);
        $this->em->persist($entity);
        $this->em->flush();

        return $this->em->getRepository($this->entity)->findBy(array('postId' => $data['postId']));
    }

    public function remove(Array $data = array())
    {
        $entity = $this->em->getRepository($this->entity)->findOneBy($data);
        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();

            return '2';
        }
    }

}