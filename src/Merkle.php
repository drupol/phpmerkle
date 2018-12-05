<?php

declare(strict_types = 1);

namespace drupol\phpmerkle;

use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Hasher\HasherInterface;

/**
 * Class Merkle
 */
class Merkle implements MerkleInterface
{
    /**
     * The hasher.
     *
     * @var \drupol\phpmerkle\Hasher\HasherInterface
     */
    private $hasher;

    /**
     * The node's hash.
     *
     * @var string|null
     */
    public $hash;

    /**
     * @var mixed[]
     */
    protected $items;

    /**
     * @var int
     */
    public $capacity;

    /**
     * Merkle constructor.
     *
     * @param int $capacity
     * @param \drupol\phpmerkle\Hasher\HasherInterface $hasher
     */
    public function __construct(
        int $capacity = 2,
        HasherInterface $hasher = null
    ) {
        $this->hasher = $hasher ?? new DoubleSha256();
        $this->capacity = $capacity;
    }

    /**
     * Hash a tree.
     *
     * @return string|null
     *   Return a hash or null.
     */
    public function hash(): ?string
    {
        if (isset($this->hash)) {
            return $this->hash;
        }

        $items = $this->items;

        while (\count($items) > 1) {
            $items = \array_map(
                [$this, 'reducePairOfStrings'],
                \array_chunk($items, $this->capacity)
            );
        }

        $this->hash = \current($items);

        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;

        $size = (int) \max([\max(\array_keys($this->items)), \count($this->items)]);

        for ($i = 0; $i < $size; $i++) {
            $this->items += [
                $i => null,
            ];
        }

        \ksort($this->items);

        $this->hash = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHasher(): HasherInterface
    {
        return $this->hasher;
    }

    /**
     * Reduce a pair of string into one.
     *
     * @param string[] $chunk
     *   The chunk.
     *
     * @return string|null
     */
    private function reducePairOfStrings(array $chunk): ?string
    {
        $filtered = \array_filter($chunk);

        if ([] === $filtered) {
            return null;
        }

        $filler = \current($filtered);

        for ($i = 0; $i < $this->capacity; $i++) {
            $chunk[$i] = $chunk[$i] ?? $filler;
        }

        return $this->getHasher()->hash(\implode('', $chunk));
    }
}
