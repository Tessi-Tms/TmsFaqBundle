<?php

/**
 *
 *@author: Danielle HODIEB <danielle.hodieb@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
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
     * @ORM\OneToMany(targetEntity="Faq", mappedBy="question", cascade={"all"})
     */
    private $faqs;

    /**
     * @ORM\ManyToOne(targetEntity="Response", inversedBy="questions")
     * @ORM\JoinColumn(name="response_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $response;

    /**
     * @ORM\ManyToMany(targetEntity="QuestionCategory", inversedBy="questions")
     * @ORM\JoinTable(name="question_catagory_question")
     */
    private $questionCategories;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->faqs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add faqs
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Faq $faqs
     * @return Question
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
     * Set response
     *
     * @param \Tms\Bundle\FaqBundle\Entity\Response $response
     * @return Question
     */
    public function setResponse(\Tms\Bundle\FaqBundle\Entity\Response $response = null)
    {
        $this->response = $response;
    
        return $this;
    }

    /**
     * Get response
     *
     * @return \Tms\Bundle\FaqBundle\Entity\Response 
     */
    public function getResponse()
    {
        return $this->response;
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
}