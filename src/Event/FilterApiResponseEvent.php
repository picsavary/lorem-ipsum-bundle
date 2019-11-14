<?php
/**
 * Last modified: 13/11/2019 15:02
 *
 * Copyright (c) 2019. picsavary@mac.com
 *
 */

namespace Amps\LoremIpsumBundle\Event;

// use Symfony\Component\EventDispatcher\Event; // before SF 4.3
use Symfony\Contracts\EventDispatcher\Event; // with SF 4.3

class FilterApiResponseEvent extends Event
{
    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function getData(): array
    {
        return $this->data;
    }
    public function setData(array $data)
    {
        $this->data = $data;
    }
}
