<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faq
 *
 * @ORM\Entity
 * @ORM\Table(name="faq")
 */
class Faq
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
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var array
     *
     * @ORM\Column(name="displayFromRules", type="object")
     */
    private $displayFromRules;

    /**
     * @var string
     *
     * @ORM\Column(name="customerId", type="string", length=32)
     */
    private $customerId;

    /**
     * @ORM\OneToMany(targetEntity="FaqQuestionCategory", mappedBy="faq", cascade={"all"})
     */
    private $questionCategories;

    /**
     * @ORM\OneToMany(targetEntity="FaqQuestion", mappedBy="faq", cascade={"all"})
     */
    private $questions;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getCustomerId();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questionCategories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Faq
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set displayFromRules
     *
     * @param \stdClass $displayFromRules
     * @return Faq
     */
    public function setDisplayFromRules($displayFromRules)
    {
        $this->displayFromRules = $displayFromRules;
    
        return $this;
    }

    /**
     * Get displayFromRules
     *
     * @return \stdClass 
     */
    public function getDisplayFromRules()
    {
        return $this->displayFromRules;
    }

    /**
     * Set customerId
     *
     * @param string $customerId
     * @return Faq
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    
        return $this;
    }

    /**
     * Get customerId
     *
     * @return string 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Add questionCategories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory $questionCategories
     * @return Faq
     */
    public function addQuestionCategorie(\Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory $questionCategories)
    {
        $this->questionCategories[] = $questionCategories;
    
        return $this;
    }

    /**
     * Remove questionCategories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory $questionCategories
     */
    public function removeQuestionCategorie(\Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory $questionCategories)
    {
        $this->questionCategories->removeElement($questionCategories);
    }

    /**
     * Get questionCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestionCategories()
    {
        return $this->questionCategories;
    }

    /**
     * Add questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqQuestion $questions
     * @return Faq
     */
    public function addQuestion(\Tms\Bundle\FaqBundle\Entity\FaqQuestion $questions)
    {
        $this->questions[] = $questions;
    
        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqQuestion $questions
     */
    public function removeQuestion(\Tms\Bundle\FaqBundle\Entity\FaqQuestion $questions)
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
}
