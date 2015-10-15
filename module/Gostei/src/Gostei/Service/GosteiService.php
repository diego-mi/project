<?php
namespace Gostei\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

/**
 * Class GosteiService
 * @package Gostei\Service
 */
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
    public function gostei($data)
    {
        $mixGosteiExistente = $this->em->getRepository($this->entity)->findby($data);

        if (count($mixGosteiExistente)) {
            return $this->remove($data);
        }
        $post = $this->em->getRepository('Post\Entity\Post')->find($data['postId']);

        $data['postAuthorId'] = $post->getAuthorId();

        $entity = new $this->entity($data);
        $this->em->persist($entity);
        $this->em->flush();

        return '1';
    }


    /**
     * @param array $data
     * @return string
     */
    public function remove(Array $data = array())
    {
        $entity = $this->em->getRepository($this->entity)->findOneBy($data);
        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();

            return '2';
        }
    }


    /**
     * @param array $data
     *
     * @return object
     */
    public function count($postId)
    {
        $arrCountGostei = $this->em->getRepository('Gostei\Entity\VwGosteiCount')->find($postId);
        return $arrCountGostei->getPostGosteiCount();
    }

}