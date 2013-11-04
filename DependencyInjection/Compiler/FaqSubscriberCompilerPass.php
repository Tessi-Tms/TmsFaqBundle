<?php

namespace Tms\Bundle\FaqBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class FaqSubscriberCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $dispatcherDefinition = $container->getDefinition('event_dispatcher');

        $taggedServices = $container->findTaggedServiceIds('tms_faq.event.subscriber');
        foreach ($taggedServices as $id => $tagAttributes) 
        {
            $dispatcherDefinition->addMethodCall(
                'addSubscriber',
                array(new Reference($id))
            );
        }
    }
}
