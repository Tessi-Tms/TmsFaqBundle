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
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var array
     *
     * @ORM\Column(name="display_from_rules", type="json_array", nullable=true)
     */
    private $displayFromRules;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_id", type="string", length=32, unique=true)
     */
    private $customerId;

    /**
     * @ORM\OneToMany(targetEntity="QuestionCategory", mappedBy="faq", cascade={"all"})
     */
    private $questionCategories;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="faq", cascade={"all"})
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
     * Set title
     *
     * @param string $title
     * @return Faq
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * @param array $displayFromRules
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
     * @return array 
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
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategories
     * @return Faq
     */
    public function addQuestionCategorie(\Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategories)
    {
        $this->questionCategories[] = $questionCategories;

        return $this;
    }

    /**
     * Remove questionCategories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategories
     */
    public function removeQuestionCategorie(\Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategories)
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
     * @param \Tms\Bundle\FaqBundle\Entity\Question $questions
     * @return Faq
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
}
