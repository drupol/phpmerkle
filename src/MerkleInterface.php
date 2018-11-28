<?php

declare(strict_types = 1);

namespace drupol\phpmerkle;

/**
 * Interface MerkleInterface
 */
interface MerkleInterface extends \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * Get the hash of the array.
     *
     * @return string
     *   The hash of the array.
     *
     * @throws \RuntimeException
     */
    public function hash(): string;
}
