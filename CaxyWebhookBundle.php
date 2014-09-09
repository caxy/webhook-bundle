<?php

namespace Caxy\Bundle\WebhookBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

class CaxyWebhookBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        if (Kernel::MINOR_VERSION < 5) {
            $pass = new \Symfony\Component\HttpKernel\DependencyInjection\RegisterListenersPass(
              'webhook_event_dispatcher',
              'webhook_event_listener',
              'webhook_event_subscriber'
            );
        } else {
            $pass = new \Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass(
              'webhook_event_dispatcher',
              'webhook_event_listener',
              'webhook_event_subscriber'
            );
        }
        $container->addCompilerPass(
          $pass,
          PassConfig::TYPE_BEFORE_REMOVING
        );
    }
}
