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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ConsumerSearch
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
     * @return ConsumerSearch
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
     * Add responses
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Response $responses
     * @return ConsumerSearch
     */
    public function addResponse(\Tms\Bundle\FaqBundle\Entity\Response $responses)
    {
        $this->responses[] = $responses;
    
        return $this;
    }

    /**
     * Remove responses
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Response $responses
     */
    public function removeResponse(\Tms\Bundle\FaqBundle\Entity\Response $responses)
    {
        $this->responses->removeElement($responses);
    }

    /**
     * Get responses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponses()
    {
        return $this->responses;
    }
}