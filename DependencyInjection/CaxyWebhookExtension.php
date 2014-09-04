<?php

namespace Caxy\Bundle\WebhookBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CaxyWebhookExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($container->getParameter('kernel.debug')) {
            $loader->load('debug.yml');

            // replace the regular event_dispatcher service with the debug one
            $definition = $container->findDefinition('caxy.webhook.event_dispatcher');
            $definition->setPublic(false);
            $container->setDefinition('caxy.webhook.debug.event_dispatcher.parent', $definition);
            $container->setAlias('caxy.webhook.event_dispatcher', 'caxy.webhook.debug.event_dispatcher');
        }
    }
}