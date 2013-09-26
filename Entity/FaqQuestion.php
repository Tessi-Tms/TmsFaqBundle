<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqQuestion
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_question")
 */
class FaqQuestion
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="questions")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $faq;

    /**
     * @ORM\OneToMany(targetEntity="FaqResponse", mappedBy="question", cascade={"all"})
     */
    private $responses;

    /**
     * @ORM\ManyToMany(targetEntity="FaqQuestionCategory")
     * @ORM\JoinTable(name="faq_questions_question_categories",
     *      joinColumns={@ORM\JoinColumn(name="question_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="question_category_id", referencedColumnName="id")}
     *      )
     */
    private $questionCategories;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getContent();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->questionCategories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set content
     *
     * @param string $content
     * @return FaqQuestion
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set faq
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Faq $faq
     * @return FaqQuestion
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

    /**
     * Add responses
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqResponse $responses
     * @return FaqQuestion
     */
    public function addResponse(\Tms\Bundle\FaqBundle\Entity\FaqResponse $responses)
    {
        $this->responses[] = $responses;
    
        return $this;
    }

    /**
     * Remove responses
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqResponse $responses
     */
    public function removeResponse(\Tms\Bundle\FaqBundle\Entity\FaqResponse $responses)
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

    /**
     * Add questionCategories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\FaqQuestionCategory $questionCategories
     * @return FaqQuestion
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
}
