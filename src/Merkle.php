<?php

declare(strict_types=1);

namespace drupol\phpmerkle;

use ArrayAccess;
use Countable;
use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Hasher\HasherInterface;
use InvalidArgumentException;
use IteratorAggregate;
use RuntimeException;

use function count;

/**
 * Class Merkle.
 */
final class Merkle implements ArrayAccess, Countable, IteratorAggregate, MerkleInterface
{
    /**
     * The capacity, a Merkle tree uses 2 by default.
     *
     * @var int
     */
    private $capacity;

    /**
     * The node's hash.
     *
     * @var string|null
     */
    private $hash;

    /**
     * The hasher.
     *
     * @var \drupol\phpmerkle\Hasher\HasherInterface
     */
    private $hasher;

    /**
     * The items.
     *
     * @var mixed[]|null
     */
    private $items;

    /**
     * Merkle constructor.
     *
     * @param int $capacity
     * @param \drupol\phpmerkle\Hasher\HasherInterface $hasher
     */
    public function __construct(
        int $capacity = 2,
        ?HasherInterface $hasher = null
    ) {
        $this->hasher = $hasher ?? new DoubleSha256();

        if (1 >= $capacity) {
            throw new InvalidArgumentException('Capacity argument must be greater than one.');
        }

        $this->capacity = $capacity;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return null === $this->items ? 0 : count($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * {@inheritdoc}
     */
    public function getHasher(): HasherInterface
    {
        return $this->hasher;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        yield from $this->items;
    }

    /**
     * Hash a tree.
     *
     * @return string|null
     *   Return a hash or null
     */
    public function hash(): ?string
    {
        if (isset($this->hash)) {
            return $this->hash;
        }

        if (null === $this->items) {
            throw new RuntimeException('Merkle tree is empty, unable to get the hash.');
        }

        $items = $this->items;

        foreach ($items as $key => $value) {
            if (null !== $value) {
                $items[$key] = $this->getHasher()->hash($value);
            }
        }

        /** @var array $items */
        $items = array_replace(
            array_pad(
                [],
                (int) max(
                    [
                        max(array_keys($items)),
                        count($items),
                        $this->capacity,
                    ]
                ),
                null
            ),
            $items
        );

        while (1 < count($items)) {
            $items = array_map(
                [$this, 'reducePairOfStrings'],
                array_chunk($items, $this->capacity)
            );
        }

        $this->hash = $this->getHasher()->unpack(current($items));

        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (null === $offset) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }

        $this->hash = null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
        $this->hash = null;
    }

    /**
     * Reduce a pair of string into one.
     *
     * @param string[] $chunk
     *   The chunk
     *
     * @return string|null
     */
    private function reducePairOfStrings(array $chunk): ?string
    {
        $filtered = array_filter($chunk);

        if ([] === $filtered) {
            return null;
        }

        $filtered += array_pad(
            [],
            $this->capacity,
            current($filtered)
        );

        return $this->getHasher()->hash(
            implode(
                '',
                $filtered
            )
        );
    }
}
