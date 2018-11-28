<?php

namespace drupol\phpmerkle\Hasher;

/**
 * Class DoubleSha256
 */
class DoubleSha256 implements HasherInterface
{
    /**
     * {@inheritdoc}
     */
    public function hash(string $data): string
    {
        return \hash('sha256', \hash('sha256', $data));
    }
}
