<?php

namespace Caxy\Bundle\WebhookBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CaxyWebhookBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new RegisterListenersPass(
                'webhook_event_dispatcher',
                'webhook_event_listener',
                'webhook_event_subscriber'
            ),
            PassConfig::TYPE_BEFORE_REMOVING
        );
    }
}
