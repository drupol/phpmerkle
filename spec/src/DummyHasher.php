<?php

namespace drupol\phpmerkle\tests;

use drupol\phpmerkle\Hasher\HasherInterface;

class DummyHasher implements HasherInterface
{
    /**
     * {@inheritdoc}
     */
    public function hash(string $data): string
    {
        return \strtoupper($data);
    }

    /**
     * {@inheritdoc}
     */
    public function unpack(string $data = null): string
    {
        return $data;
    }
}
