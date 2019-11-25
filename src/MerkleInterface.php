<?php

declare(strict_types=1);

namespace drupol\phpmerkle;

/**
 * Class MerkleInterface.
 */
interface MerkleInterface
{
    /**
     * @return string|null
     */
    public function hash(): ?string;
}
