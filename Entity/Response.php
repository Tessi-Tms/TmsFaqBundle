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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Response
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
     * @return Response
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
     * Add questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $questions
     * @return Response
     */
    public function addQuestion(\Tms\Bundle\FaqBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;
    
        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $questions
     */
    public function removeQuestion(\Tms\Bundle\FaqBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set evaluation
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Evaluation $evaluation
     * @return Response
     */
    public function setEvaluation(\Tms\Bundle\FaqBundle\Entity\Evaluation $evaluation = null)
    {
        $this->evaluation = $evaluation;
    
        return $this;
    }

    /**
     * Get evaluation
     *
     * @return \Tms\Bundle\FaqBundle\Entity\Evaluation 
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set consumerSearch
     *
     * @param \Tms\Bundle\FaqBundle\Entity\ConsumerSearch $consumerSearch
     * @return Response
     */
    public function setConsumerSearch(\Tms\Bundle\FaqBundle\Entity\ConsumerSearch $consumerSearch = null)
    {
        $this->consumerSearch = $consumerSearch;
    
        return $this;
    }

    /**
     * Get consumerSearch
     *
     * @return \Tms\Bundle\FaqBundle\Entity\ConsumerSearch 
     */
    public function getConsumerSearch()
    {
        return $this->consumerSearch;
    }
}