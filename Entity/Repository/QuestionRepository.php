<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * QuestionRepository
 */
class QuestionRepository extends EntityRepository
{
    /**
     * Get search Questions
     *
     * @param array $ids
     * @return array
     */
    public function findAllIn($ids, $faq)
    {
        $qb = $this->createQueryBuilder('question');

        return $qb
            ->where($qb->expr()->in('question.id', $ids))
            //->andwhere($qb->expr()->in('question.faq', $faq->getId()))
            ->getQuery()
            ->getResult()
        ;
    }
}
