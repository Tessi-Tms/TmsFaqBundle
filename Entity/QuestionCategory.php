<?php

/**
 *
 * @author Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @author Pichet PUTH <pichet.puth@utt.fr>
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tms\Bundle\FaqBundle\Tools\StringTools;

/**
 * QuestionCategory
 *
 * @ORM\Entity(repositoryClass="\Tms\Bundle\FaqBundle\Entity\Repository\QuestionCategoryRepository")
 * @ORM\Table(name="faq_question_category", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="faq_question_category_name", columns={"name", "faq_id"}),
 *     @ORM\UniqueConstraint(name="faq_question_category_slug", columns={"slug", "faq_id"})
 * })
 * @ORM\HasLifecycleCallbacks()
 */
class QuestionCategory
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
     * @var media
     *
     * @ORM\OneToOne(targetEntity="Tms\Bundle\MediaClientBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(name="icon_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $icon;

    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="categories")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $faq;

    /**
     * @ORM\ManyToMany(targetEntity="Question", mappedBy="categories")
     */
    private $questions;

    /**
     * toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s', $this->getName());
    }

    /**
     * Generate Slug
     *
     * @return string
     */
    protected function generateSlug()
    {
        return StringTools::slugify(sprintf(
            '%s',
            $this->getName()
        ));
    }

    /**
     * Get tags
     *
     * @return array
     */
    public function getTags()
    {
        $tags = array();
        foreach ($this->getQuestions() as $question) {
            foreach ($question->getTags() as $tag) {
                $tags[$tag->getKey()] = $tag->getValue();
            }
        }

        return $tags;
    }

    /**
     * onCreate
     * @ORM\PrePersist()
     */
    public function onCreate()
    {
        $this->setSlug($this->generateSlug());
    }

    /**
     * onUpdate
     * @ORM\PreUpdate()
     */
    public function onUpdate()
    {
        $this->setSlug($this->generateSlug());
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set icon
     *
     * @param \Tms\Bundle\MediaClientBundle\Entity\Media $icon
     * @return QuestionCategory
     */
    public function setIcon(\Tms\Bundle\MediaClientBundle\Entity\Media $icon = null)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return \Tms\Bundle\MediaClientBundle\Entity\Media
     */
    public function getIcon()
    {
        return $this->icon;
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
     * Add questions
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $question
     * @return QuestionCategory
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