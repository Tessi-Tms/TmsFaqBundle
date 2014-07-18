<?php

/**
 *
 * @author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @author: Pichet PUTH <pichet.puth@utt.fr>
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Entity
 * @ORM\Table(name="faq_evaluation")
 * @ORM\HasLifecycleCallbacks()
 */
class Evaluation
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
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="evaluations")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $question;

    /**
     * On create
     *
     * @ORM\PrePersist()
     */
    public function onCreate()
    {
        $now = new \DateTime();
        $this
            ->setCreatedAt($now)
        ;
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
     * Set value
     *
     * @param integer $value
     * @return Evaluation
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set question
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $question
     * @return Evaluation
     */
    public function setQuestion(\Tms\Bundle\FaqBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Tms\Bundle\FaqBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Evaluation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}