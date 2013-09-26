<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuestionCategory
 *
 * @ORM\Entity
 * @ORM\Table(name="question_category")
 */
class QuestionCategory
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
     * @ORM\OneToMany(targetEntity="Faq", mappedBy="questionCategory", cascade={"all"})
     */
    private $faqs;

    /**
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="questionCategories")
     */
    private $questions;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->faqs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return QuestionCategory
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
     * Add faqs
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Faq $faqs
     * @return QuestionCategory
     */
    public function addFaq(\Tms\Bundle\FaqBundle\Entity\Faq $faqs)
    {
        $this->faqs[] = $faqs;
    
        return $this;
    }

    /**
     * Remove faqs
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Faq $faqs
     */
    public function removeFaq(\Tms\Bundle\FaqBundle\Entity\Faq $faqs)
    {
        $this->faqs->removeElement($faqs);
    }

    /**
     * Get faqs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFaqs()
    {
        return $this->faqs;
    }

    /**
     * Add questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $questions
     * @return QuestionCategory
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