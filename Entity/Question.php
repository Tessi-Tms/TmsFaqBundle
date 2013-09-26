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
}
