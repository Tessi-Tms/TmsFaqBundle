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
}
