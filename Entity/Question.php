<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IDCI\Bundle\SimpleMetadataBundle\Metadata\MetadatableInterface;

/**
 * Question
 *
 * @ORM\Entity(repositoryClass="\Tms\Bundle\FaqBundle\Entity\Repository\QuestionRepository")
 * @ORM\Table(name="faq_question")
 */
class Question implements MetadatableInterface
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
     * @var text
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="questions")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $faq;

    /**
     * @ORM\OneToMany(targetEntity="Response", mappedBy="question", cascade={"all"})
     */
    private $responses;

    /**
     * @ORM\ManyToMany(targetEntity="QuestionCategory", inversedBy="questions")
     * @ORM\JoinTable(name="faq_question_question_categories")
     */
    private $questionCategories;

    /**
     * @var array<Metadata>
     *
     * @ORM\ManyToMany(targetEntity="IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata", cascade={"all"})
     * @ORM\JoinTable(name="faq_question_tag",
     *     joinColumns={@ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", unique=true, onDelete="cascade")}
     * )
     */
    private $tags;

    /**
     * toString
     */
    public function __toString()
    {
        return $this->getContent();
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadatas()
    {
        return $this->getTags();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->responses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->questionCategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Question
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
     * @return Question
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
     * @param \Tms\Bundle\FaqBundle\Entity\Response $responses
     * @return Question
     */
    public function addResponse(\Tms\Bundle\FaqBundle\Entity\Response $responses)
    {
        if (!$responses->getQuestion()) {
            $responses->setQuestion($this);
        }
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

    /**
     * Add questionCategories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategories
     * @return Question
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
     * Add tags
     *
     * @param \IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tags
     * @return Question
     */
    public function addTag(\IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tags
     */
    public function removeTag(\IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
