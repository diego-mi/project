<?php

namespace Gostei\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GosteiRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GosteiRepository extends EntityRepository
{
    public function getGostei($arrPostId, $intUserId)
    {
        $query = $this->_em->createQuery(
            'SELECT u.postId FROM Gostei\Entity\Gostei u WHERE u.postId IN ('
            . $arrPostId .') AND u.userId = ' . $intUserId);
        return $query->getResult();
    }
}
