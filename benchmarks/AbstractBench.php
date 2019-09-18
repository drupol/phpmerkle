<?php

declare(strict_types=1);

namespace drupol\phpmerkle\benchmarks;

abstract class AbstractBench
{
    /**
     * @return array
     */
    public function getData()
    {
        return \array_merge(\range('a', 'z'), \range('A', 'Z'));
    }
}
