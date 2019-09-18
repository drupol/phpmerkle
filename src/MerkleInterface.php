<?php

declare(strict_types=1);

namespace drupol\phpmerkle;

/**
 * Class MerkleInterface.
 */
interface MerkleInterface extends \ArrayAccess
{
    /**
     * @return null|string
     */
    public function hash(): ?string;
}
