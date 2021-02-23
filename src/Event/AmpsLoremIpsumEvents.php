<?php
/**
 * Last modified: 13/11/2019 15:54
 *
 * Copyright (c) 2019. picsavary@icloud.com
 *
 */

namespace Amps\LoremIpsumBundle\Event;

/**
 * Class AmpsLoremIpsumEvents
 *
 * @package Amps\LoremIpsumBundle\Event
 *
 */
final class AmpsLoremIpsumEvents
{
    /**
     * Called directly before the Lorem Ipsum API data is returned.
     *
     * Listeners have the opportunity to change that data.
     *
     * @Event("Amps\LoremIpsumBundle\Event\FilterApiResponseEvent")
     *
     */
    const FILTER_API = 'amps_lorem_ipsum.filter_api';
}