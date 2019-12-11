<?php

declare(strict_types=1);

namespace drupol\phpmerkle\Hasher;

/**
 * Class DummyHasher.
 */
class DummyHasher implements HasherInterface
{
    /**
     * {@inheritdoc}
     */
    public function hash(string $data, bool $raw_output = true): string
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function unpack(?string $data = null): string
    {
        return $data ?? '';
    }
}
