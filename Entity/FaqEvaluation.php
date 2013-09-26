<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqEvaluation
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_evaluation")
 */
class FaqEvaluation
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
     * @var integer
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="FaqResponse", inversedBy="evaluations")
     * @ORM\JoinColumn(name="response_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $response;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getValue();
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
     * Set value
     *
     * @param integer $value
     * @return FaqEvaluation
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FaqEvaluation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set response
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqResponse $response
     * @return FaqEvaluation
     */
    public function setResponse(\Tms\Bundle\FaqBundle\Entity\FaqResponse $response = null)
    {
        $this->response = $response;
    
        return $this;
    }

    /**
     * Get response
     *
     * @return \Tms\Bundle\FaqBundle\Entity\FaqResponse 
     */
    public function getResponse()
    {
        return $this->response;
    }
}