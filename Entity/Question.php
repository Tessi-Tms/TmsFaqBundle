<?php

/**
 *
 * @author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @author: Pichet PUTH <pichet.puth@utt.fr>
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use IDCI\Bundle\SimpleMetadataBundle\Metadata\MetadatableInterface;
use Tms\Bundle\SearchBundle\IndexableElement\IndexableElementInterface;

/**
 * Question
 *
 * @ORM\Entity(repositoryClass="\Tms\Bundle\FaqBundle\Entity\Repository\QuestionRepository")
 * @ORM\Table(name="faq_question")
 * @ORM\HasLifecycleCallbacks()
 */
class Question
//implements MetadatableInterface, IndexableElementInterface
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
     * @var text
     *
     * @ORM\Column(type="text")
     */
    private $question;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     */
    private $answer;

    /**
     * @var decimal
     *
     * @ORM\Column(type="decimal", precision=5, scale=2, options={"default" = 0})
     */
    private $average;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_yep", type="integer", options={"default" = 0})
     */
    private $countYep;

    /**
     * @var integer
     *
     * @ORM\Column(name="count_nope", type="integer", options={"default" = 0})
     */
    private $countNope;

    /**
     * @ORM\ManyToOne(targetEntity="Faq", inversedBy="questions")
     * @ORM\JoinColumn(name="faq_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $faq;

    /**
     * @ORM\ManyToMany(targetEntity="QuestionCategory", inversedBy="questions")
     * @ORM\JoinTable(name="faq_question_question_categories")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Evaluation", mappedBy="question")
     */
    private $evaluations;

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
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s', $this->getQuestion());
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->average = 0;
        $this->countYep = 0;
        $this->countNope = 0;
    }

    /**
     * Update average
     */
    public function updateAverage()
    {
        $this->setAverage($this->computeAverage());
    }

    /**
     * Compute average
     *
     * @return float
     */
    protected function computeAverage()
    {
        $sum = 0;
        $evaluations = $this->getEvaluations();

        if(count($evaluations) > 0) {
            foreach ($evaluations as $evaluation) {
                $sum = $sum + $evaluation->getValue();
            }

            return $sum / count($evaluations);
        } else {
            return 0;
        }
    }

    /**
     * Add Yep
     */
    public function addYep()
    {
        $this->setCountYep($this->getCountYep() + 1);
    }

    /**
     * Add Nope
     */
    public function addNope()
    {
        $this->setCountNope($this->getCountNope() + 1);
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
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Question
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set average
     *
     * @param string $average
     * @return Question
     */
    public function setAverage($average)
    {
        $this->average = $average;

        return $this;
    }

    /**
     * Get average
     *
     * @return float
     */
    public function getAverage()
    {
        return $this->average;
    }

    /**
     * Set countYep
     *
     * @param integer $countYep
     * @return Question
     */
    public function setCountYep($countYep)
    {
        $this->countYep = $countYep;

        return $this;
    }

    /**
     * Get countYep
     *
     * @return integer
     */
    public function getCountYep()
    {
        return $this->countYep;
    }

    /**
     * Set countNope
     *
     * @param integer $countNope
     * @return Question
     */
    public function setCountNope($countNope)
    {
        $this->countNope = $countNope;

        return $this;
    }

    /**
     * Get countNope
     *
     * @return integer
     */
    public function getCountNope()
    {
        return $this->countNope;
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
     * Add categories
     *
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $category
     * @return Question
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
     * Add evaluations
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Evaluation $evaluation
     * @return Question
     */
    public function addEvaluation(\Tms\Bundle\FaqBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluations
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\Tms\Bundle\FaqBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Add tag
     *
     * @param \IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tag
     * @return Question
     */
    public function addTag(\IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tags
     */
    public function removeTag(\IDCI\Bundle\SimpleMetadataBundle\Entity\Metadata $tag)
    {
        $this->tags->removeElement($tag);
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