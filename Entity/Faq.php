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
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="faqs")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity="QuestionCategory", inversedBy="faqs")
     * @ORM\JoinColumn(name="question_category_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $questionCategory;

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
     * Set question
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Question $question
     * @return Faq
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
     * Set questionCategory
     *
     * @param \Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategory
     * @return Faq
     */
    public function setQuestionCategory(\Tms\Bundle\FaqBundle\Entity\QuestionCategory $questionCategory = null)
    {
        $this->questionCategory = $questionCategory;
    
        return $this;
    }

    /**
     * Get questionCategory
     *
     * @return \Tms\Bundle\FaqBundle\Entity\QuestionCategory 
     */
    public function getQuestionCategory()
    {
        return $this->questionCategory;
    }
}