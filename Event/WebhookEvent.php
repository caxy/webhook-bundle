<?php

namespace Caxy\Bundle\WebhookBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebhookEvent
 * @package Caxy\Bundle\WebhookBundle\Event
 */
class WebhookEvent extends Event
{
    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->request->getContent();
    }
}
