<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqConsumerSearch
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_consumer_search")
 */
class FaqConsumerSearch
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
     * @ORM\ManyToOne(targetEntity="FaqResponse", inversedBy="consumerSearchs")
     * @ORM\JoinColumn(name="response_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $response;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getQuery();
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
     * Set query
     *
     * @param string $query
     * @return FaqConsumerSearch
     */
    public function setQuery($query)
    {
        $this->query = $query;
    
        return $this;
    }

    /**
     * Get query
     *
     * @return string 
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set isProper
     *
     * @param boolean $isProper
     * @return FaqConsumerSearch
     */
    public function setIsProper($isProper)
    {
        $this->isProper = $isProper;
    
        return $this;
    }

    /**
     * Get isProper
     *
     * @return boolean 
     */
    public function getIsProper()
    {
        return $this->isProper;
    }

    /**
     * Set response
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqResponse $response
     * @return FaqConsumerSearch
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