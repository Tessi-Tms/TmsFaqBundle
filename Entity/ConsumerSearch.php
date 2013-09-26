<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConsumerSearch
 *
 * @ORM\Entity
 * @ORM\Table(name="consumer_search")
 */
class ConsumerSearch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="query", type="string", length=255)
     */
    private $query;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isProper", type="boolean")
     */
    private $isProper;

    /**
     * @ORM\OneToMany(targetEntity="Response", mappedBy="consumerSearch", cascade={"all"})
     */
    private $responses;
}
