<?php

namespace Caxy\Bundle\WebhookBundle\Controller;

use Caxy\Bundle\WebhookBundle\Event\WebhookEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WebhookController
 * @package Caxy\Bundle\WebhookBundle\Controller
 */
class WebhookController
{
    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function handleAction(Request $request)
    {
        $event = $this->dispatcher->dispatch('webhook', new WebhookEvent($request));

        return new Response();
    }
}