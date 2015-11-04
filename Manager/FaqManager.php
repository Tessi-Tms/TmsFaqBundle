<?php

/**
 * @author Pichet Puth <pichet.puth@utt.fr>
 */

namespace Tms\Bundle\FaqBundle\Manager;

use Tms\Bundle\FaqBundle\Entity\Faq;
use Tms\Bundle\FaqBundle\Event\FaqEvent;
use Tms\Bundle\FaqBundle\Event\FaqEvents;
use Tms\Bundle\FaqBundle\FaqOwnerInterface;

class FaqManager extends AbstractManager
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClass()
    {
        return "TmsFaqBundle:Faq";
    }

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqEvents::PRE_CREATE,
            new FaqEvent($entity)
        );

        parent::add($entity);

        $this->getEventDispatcher()->dispatch(
            FaqEvents::POST_CREATE,
            new FaqEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqEvents::PRE_UPDATE,
            new FaqEvent($entity)
        );

        parent::update($entity);

        $this->getEventDispatcher()->dispatch(
            FaqEvents::POST_UPDATE,
            new FaqEvent($entity)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $this->getEventDispatcher()->dispatch(
            FaqEvents::PRE_DELETE,
            new FaqEvent($entity)
        );

        parent::delete($entity);

        $this->getEventDispatcher()->dispatch(
            FaqEvents::POST_DELETE,
            new FaqEvent($entity)
        );
    }

    /**
     * Get the FaqOwner object
     *
     * @param string $objectClassName
     * @param string $objectId
     * @return FaqOwnerInterface
     */
    public function getFaqOwnerObject($objectClassName, $objectId)
    {
        return $this
            ->getEntityManager()
            ->getRepository($objectClassName)
            ->findOneBy(array('id' => $objectId))
        ;
    }

    /**
     * Get the class name of FaqOwnerInterface
     *
     * @param FaqOwnerInterface $faqOwner
     * @return string
     */
    public function getClassName(FaqOwnerInterface $faqOwner)
    {
        $reflecion = new \ReflectionClass($faqOwner);

        return $reflecion->getName();
    }

    /**
     * Generate a Hash from a FaqOwnerInterface
     *
     * @param FaqOwnerInterface $faqOwner
     * @return string
     */
    public function generateHash(FaqOwnerInterface $faqOwner)
    {
        return md5(sprintf('%s - %s',
            \Doctrine\Common\Util\ClassUtils::getRealClass($this->getClassName($faqOwner)),
            $faqOwner->getId()
        ));
    }

    /**
     * Fetch an object (FaqOwnerInterface) related to a faq and create the association
     *
     * @param Faq $faq
     */
    public function fetchObject(Faq & $faq)
    {
        $faqOwner = $this->getFaqOwnerObject(
            $faq->getObjectClassName(),
            $faq->getObjectId()
        );

        $faq->setObject($faqOwner);
    }
}
