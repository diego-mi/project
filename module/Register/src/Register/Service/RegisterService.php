<?php
namespace Register\Service;

use Doctrine\ORM\EntityManager;

class RegisterService
{

    protected $em;
    protected $entity;

    public function __construct(EntityManager $em)
    {
        $this->entity = 'Register\Entity\User';
        $this->em = $em;
    }

    public function register($data)
    {
        $entity = new $this->entity();
        $entity->setUsername($data['username']);
        $entity->setName($data['name']);
        $entity->setEmail($data['email']);
        $entity->setPassword($data['password']);
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}