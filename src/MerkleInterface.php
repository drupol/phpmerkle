<?php

declare(strict_types=1);

namespace drupol\phpmerkle;

use drupol\phpmerkle\Hasher\HasherInterface;

/**
 * Class MerkleInterface.
 */
interface MerkleInterface
{
    /**
     * @return int
     */
    public function getCapacity(): int;

    /**
     * @return \drupol\phpmerkle\Hasher\HasherInterface
     */
    public function getHasher(): HasherInterface;

    /**
     * @return string|null
     */
    public function hash(): ?string;
}
