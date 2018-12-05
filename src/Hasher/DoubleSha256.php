<?php

namespace drupol\phpmerkle\Hasher;

/**
 * Class DoubleSha256
 */
class DoubleSha256 extends Sha256
{
    /**
     * @var \drupol\phpmerkle\Hasher\Sha256
     */
    private $sha256;

    /**
     * DoubleSha256 constructor.
     */
    public function __construct()
    {
        $this->sha256 = new Sha256();
    }

    /**
     * {@inheritdoc}
     */
    public function hash(string $data, bool $raw_output = true): string
    {
        return $this->sha256->hash($this->sha256->hash($data, $raw_output), $raw_output);
    }
}
