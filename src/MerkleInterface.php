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

    /**
     * Get the state of the tree at a particular level.
     *
     * @param int $level
     *   The level.
     *
     * @return string[]
     *   The hashes array.
     */
    public function level(int $level): array;

    /**
     * Get the tree depth.
     *
     * @return int
     *   The tree depth.
     */
    public function depth(): int;
}
