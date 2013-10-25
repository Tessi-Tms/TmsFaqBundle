<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tms\Bundle\FaqBundle\Tools\StringTools;

/**
 * QuestionCategory
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_question_category", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="faq_question_category", columns={"name","faq_id"})
 * })
 * @ORM\HasLifecycleCallbacks()
 */
class QuestionCategory
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
     * @ORM\Column(type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="questionCategories")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $faq;

    /**
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="questionCategories", cascade={"all"})
     */
    private $questions;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * On create
     *
     * @ORM\PrePersist()
     */
    public function onCreate()
    {
        $this->setSlug(StringTools::slugify($this->getName()));
    }

    /**
     * On update
     *
     * @ORM\PreUpdate()
     */
    public function onUpdate()
    {
        $this->setSlug(StringTools::slugify($this->getName()));
    }

    /**
     * Get tags
     *
     * @return array<Metadata> 
     */
    public function getTags()
    {
        $tags = array();
        foreach($this->getQuestions() as $question) {
            foreach($question->getTags() as $tag) {
                $tags[$tag->getKey()] = $tag;
            }
        }

        return $tags;
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
     * Set slug
     *
     * @param string $slug
     * @return QuestionCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set faq
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Faq $faq
     * @return QuestionCategory
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
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
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
