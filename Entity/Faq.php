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
 * @ORM\Entity(repositoryClass="\Tms\Bundle\FaqBundle\Entity\Repository\FaqRepository")
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
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="object_class_name", type="string", length=255)
     */
    private $objectClassName;

    /**
     * @var string
     *
     * @ORM\Column(name="object_id", type="string", length=64)
     */
    private $objectId;

    /**
     * @ORM\OneToMany(targetEntity="QuestionCategory", mappedBy="faq", cascade={"all"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="faq", cascade={"all"})
     */
    private $questions;

    /**
     * @var FaqOwnerInterface
     */
    private $object;

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
     * Get Object
     *
     * @return FaqOwnerInterface
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set Object
     *
     * @param  FaqOwnerInterface $object
     * @return Faq
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
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
     * Set hash
     *
     * @param string $hash
     * @return Faq
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set objectClassName
     *
     * @param string $objectClassName
     * @return Faq
     */
    public function setObjectClassName($objectClassName)
    {
        $this->objectClassName = $objectClassName;

        return $this;
    }

    /**
     * Get objectClassName
     *
     * @return string
     */
    public function getObjectClassName()
    {
        return $this->objectClassName;
    }

    /**
     * Set objectId
     *
     * @param string $objectId
     * @return Faq
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * Get objectId
     *
     * @return string
     */
    public function getObjectId()
    {
        return $this->objectId;
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
