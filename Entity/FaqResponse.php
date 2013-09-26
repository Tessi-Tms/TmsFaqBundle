<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqResponse
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_response")
 */
class FaqResponse
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
     * @ORM\ManyToOne(targetEntity="FaqQuestion", inversedBy="responses")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="FaqEvaluation", mappedBy="response", cascade={"all"})
     */
    private $evaluations;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getMessage();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return FaqResponse
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set average
     *
     * @param float $average
     * @return FaqResponse
     */
    public function setAverage($average)
    {
        $this->average = $average;
    
        return $this;
    }

    /**
     * Get average
     *
     * @return float 
     */
    public function getAverage()
    {
        return $this->average;
    }

    /**
     * Set question
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqQuestion $question
     * @return FaqResponse
     */
    public function setQuestion(\Tms\Bundle\FaqBundle\Entity\FaqQuestion $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \Tms\Bundle\FaqBundle\Entity\FaqQuestion 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add evaluations
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqEvaluation $evaluations
     * @return FaqResponse
     */
    public function addEvaluation(\Tms\Bundle\FaqBundle\Entity\FaqEvaluation $evaluations)
    {
        $this->evaluations[] = $evaluations;
    
        return $this;
    }

    /**
     * Remove evaluations
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqEvaluation $evaluations
     */
    public function removeEvaluation(\Tms\Bundle\FaqBundle\Entity\FaqEvaluation $evaluations)
    {
        $this->evaluations->removeElement($evaluations);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }
}