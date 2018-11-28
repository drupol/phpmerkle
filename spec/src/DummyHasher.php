<?php

namespace drupol\phpmerkle\tests;

use drupol\phpmerkle\Hasher\HasherInterface;

class DummyHasher implements HasherInterface
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function hash(string $data): string
    {
        return 'dummy';
    }
}
