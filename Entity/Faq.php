<?php

/**
 *
 * @author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @author: Pichet PUTH <>pichet.puth@utt.fr
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
     * @ORM\Id
     * @ORM\Column(type="integer")
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
     * @var string
     *
     * @ORM\Column(name="customer_id", type="string", length=32, unique=true)
     */
    private $customerId;

    /**
     * @ORM\OneToMany(targetEntity="QuestionCategory", mappedBy="faq")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="faq")
     */
    private $questions;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s', $this->getTitle());
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add categories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $category
     * @return Faq
     */
    public function addCategorie(\Tms\Bundle\FaqBundle\Entity\QuestionCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $category
     */
    public function removeCategorie(\Tms\Bundle\FaqBundle\Entity\QuestionCategory $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $question
     * @return Faq
     */
    public function addQuestion(\Tms\Bundle\FaqBundle\Entity\Question $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $question
     */
    public function removeQuestion(\Tms\Bundle\FaqBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
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