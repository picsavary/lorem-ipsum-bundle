<?php
/**
 * Last modified: 13/11/2019 01:11
 *
 * Copyright (c) 2019. picsavary@mac.com
 *
 */

namespace Amps\LoremIpsumBundle\Controller;

use Amps\LoremIpsumBundle\Event\FilterApiResponseEvent;
use Amps\LoremIpsumBundle\Event\AmpsLoremIpsumEvents;
use Amps\LoremIpsumBundle\KnpUIpsum;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class IpsumApiController
 *
 * @package Amps\LoremIpsumBundle\Controller
 *
 */
class IpsumApiController
{
    /**
     * @var KnpUIpsum
     *
     */
    private $knpUIpsum;

    /**
     * @var EventDispatcherInterface
     *
     */
    private $eventDispatcher;

    /**
     * IpsumApiController constructor.
     * @param KnpUIpsum $knpUIpsum
     *
     * @param EventDispatcherInterface $eventDispatcher
     *
     */
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
            'sentences' => $this->knpUIpsum->getSentences(),
        ];
        $event = new FilterApiResponseEvent($data);
        if ($this->eventDispatcher) {
            // $this->eventDispatcher->dispatch('amps_lorem_ipsum.filter_api', $event ); before SF 4.3
            $this
                ->eventDispatcher
                ->dispatch(
                    $event,
                    AmpsLoremIpsumEvents::FILTER_API // now optional
                ); // SF 4.3

        }

        $response =  new JsonResponse();

        $response->setData($event->getData());
        return $response;
    }
}
