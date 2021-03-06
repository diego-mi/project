<?php

namespace Auth\Entity;

use Auth\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * AuthRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    /**
     * @param Usario $usuario
     * @param $username
     * @param $password
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByLoginAndPassword(User $usuario, $username, $password)
    {
        $userUsername = $this
            ->createQueryBuilder('u')
            ->where('u.username = :a1')
            ->andWhere('u.password = :a2')
            ->setParameter('a1', $username)
            ->setParameter('a2', $password)
            ->getQuery()
            ->getOneOrNullResult();

        if (!is_null($userUsername)) {
            return $userUsername;
        }
        return false;
    }
}
