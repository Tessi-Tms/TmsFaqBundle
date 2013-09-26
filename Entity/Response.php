<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Response
 *
 * @ORM\Entity
 * @ORM\Table(name="response")
 */
class Response
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
     * @var text
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var float
     *
     * @ORM\Column(name="average",type="float")
     */
    private $average;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="response", cascade={"all"})
     */
    private $questions;

    /**
     * @ORM\ManyToOne(targetEntity="Evaluation", inversedBy="responses")
     * @ORM\JoinColumn(name="evaluation_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity="ConsumerSearch", inversedBy="responses")
     * @ORM\JoinColumn(name="consumer_search_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $consumerSearch;
}
