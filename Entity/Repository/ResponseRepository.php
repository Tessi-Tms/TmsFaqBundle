<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * ResponseRepository
 */
class ResponseRepository extends EntityRepository
{
    /**
     * Get search Responses
     *
     * @param array $ids
     * @return array
     */
    public function findAllIn($ids)
    {
        $qb = $this->createQueryBuilder('response');

        return $qb
            ->where($qb->expr()->in('response.id', $ids))
            ->getQuery()
            ->getResult()
        ;
    }
}
