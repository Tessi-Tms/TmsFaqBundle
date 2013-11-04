<?php

/**
 * 
 * @author:  TESSI Marketing <contact@tessi.fr>
 *
 */

namespace Tms\Bundle\FaqBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tms\Bundle\FaqBundle\DependencyInjection\Compiler\FaqSubscriberCompilerPass;

class TmsFaqBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FaqSubscriberCompilerPass());
    }
}
