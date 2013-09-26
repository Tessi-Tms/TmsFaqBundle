<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqQuestionCategory
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_question_category")
 */
class FaqQuestionCategory
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
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="questionCategories")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $faq;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return FaqQuestionCategory
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set faq
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Faq $faq
     * @return FaqQuestionCategory
     */
    public function setFaq(\Tms\Bundle\FaqBundle\Entity\Faq $faq = null)
    {
        $this->faq = $faq;
    
        return $this;
    }

    /**
     * Get faq
     *
     * @return \Tms\Bundle\FaqBundle\Entity\Faq 
     */
    public function getFaq()
    {
        return $this->faq;
    }
}