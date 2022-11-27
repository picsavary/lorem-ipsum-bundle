<?php
/**
 * Last modified: 13/11/2019 01:11
 *
 * Copyright (c) 2019. picsavary@icloud.com
 *
 */

namespace Amps\LoremIpsumBundle\Controller;

use Amps\LoremIpsumBundle\Event\FilterApiResponseEvent;
use Amps\LoremIpsumBundle\Event\AmpsLoremIpsumEvents;
use Amps\LoremIpsumBundle\KnpUIpsum;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class IpsumApiController
{
    private KnpUIpsum $knpUIpsum;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        KnpUIpsum $knpUIpsum,
        EventDispatcherInterface $eventDispatcher = null // eventdispatcher comes from frameworkBundle
    )
    {
        $this->knpUIpsum = $knpUIpsum;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function index()
    {
        $data = [
        'paragraphs' => $this->knpUIpsum->getParagraphs(),
        'sentences' => $this->knpUIpsum->getSentences()
        ];

        $event = new FilterApiResponseEvent($data);
        if ($this->eventDispatcher) {
            $this
                ->eventDispatcher
                ->dispatch(
                    $event,
                    AmpsLoremIpsumEvents::FILTER_API
                );
        }

        $response =  new JsonResponse();
        $response->setData($event->getData());
        return $response;
    }
}
