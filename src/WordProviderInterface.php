<?php

/**
 * Copyright (c) 2018. picsavary@icloud.com
 */

declare(strict_types=1);

namespace Amps\LoremIpsumBundle;

/**
 * Interface WordProviderInterface
 * @package Amps\LoremIpsumBundle
 */
interface WordProviderInterface
{
    /**
     * Return an array of words to use for the fake text.
     */
    public function getWordList(): array;
}
