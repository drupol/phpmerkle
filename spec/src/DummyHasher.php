<?php

declare(strict_types=1);

namespace drupol\phpmerkle\tests;

use drupol\phpmerkle\Hasher\HasherInterface;

class DummyHasher implements HasherInterface
{
    /**
     * {@inheritdoc}
     */
    public function hash(string $data, bool $raw_output = true): string
    {
        return \mb_strtoupper($data);
    }

    /**
     * {@inheritdoc}
     */
    public function unpack(string $data = null): string
    {
        return $data;
    }
}
