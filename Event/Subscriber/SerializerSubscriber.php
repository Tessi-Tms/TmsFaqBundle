<?php

namespace Tms\Bundle\FaqBundle\Event\Subscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\EventDispatcher\Events;
use Tms\Bundle\FaqBundle\FaqOwnerInterface;
use Tms\Bundle\FaqBundle\Manager\FaqManager;

/**
 * SerializerSubscriber
 *
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */
class SerializerSubscriber implements EventSubscriberInterface
{
    protected $faqManager;

    /**
     * Constructor
     *
     * @param FaqManager $faqManager
     */
    public function __construct(FaqManager $faqManager)
    {
        $this->faqManager = $faqManager;
    }

    /**
     * Get faq manager
     *
     * @return FaqManager
     */
    public function getFaqManager()
    {
        return $this->faqManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event'     => Events::POST_SERIALIZE,
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method'    => 'onPostSerialize',
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onPostSerialize(ObjectEvent $event)
    {
        $object = $event->getObject();

        if ($object instanceof FaqOwnerInterface) {
            $hash = $this->getFaqManager()->generateHash($object);
            $collection = $this->getFaqManager()->findBy(array('hash' => $hash));

            if (null !== $collection) {
                $defaultFaq = false;
                $faqs = array();
                foreach ($collection as $faq) {
                    if (!$faq->getEnabled()) {
                        continue;
                    }

                    if (!$defaultFaq) {
                        $defaultFaq = true;
                        $event->getVisitor()->addData('faq', array(
                            'id'      => $faq->getId(),
                            'enabled' => $faq->getEnabled(),
                        ));
                    }

                    $faqs[] = array(
                        'id'      => $faq->getId(),
                        'enabled' => $faq->getEnabled(),
                    );
                }

                if (!empty($faqs)) {
                    $event->getVisitor()->addData('faqs', $faqs);
                }
            }
        }
    }
}
