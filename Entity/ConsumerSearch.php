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
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $query;

    /**
     * @var boolean
     *
     * @ORM\Column(name="answer_found", type="boolean")
     */
    private $answerFound;

    /**
     * @ORM\ManyToOne(targetEntity="Response", inversedBy="consumerSearchs")
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
     * Set answerFound
     *
     * @param boolean $answerFound
     * @return ConsumerSearch
     */
    public function setAnswerFound($answerFound)
    {
        $this->answerFound = $answerFound;
    
        return $this;
    }

    /**
     * Get answerFound
     *
     * @return boolean 
     */
    public function isAnswerFound()
    {
        return $this->answerFound;
    }

    /**
     * Set response
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Response $response
     * @return ConsumerSearch
     */
    public function setResponse(\Tms\Bundle\FaqBundle\Entity\Response $response = null)
    {
        $this->response = $response;
    
        return $this;
    }

    /**
     * Get response
     *
     * @return \Tms\Bundle\FaqBundle\Entity\Response 
     */
    public function getResponse()
    {
        return $this->response;
    }
}
