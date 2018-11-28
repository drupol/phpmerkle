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
     * @var string[]
     */
    private $storage;

    /**
     * @var string|null
     */
    private $hash;

    /**
     * @var HasherInterface
     */
    private $hasher;

    /**
     * Merkle constructor.
     *
     * @param array $data
     * @param HasherInterface|null $hasher
     */
    public function __construct(array $data = [], HasherInterface $hasher = null)
    {
        $this->storage = $data;
        $this->hasher = $hasher ?? new DoubleSha256();
    }

    /**
     * {@inheritdoc}
     */
    public function hash(): string
    {
        if (null !== $this->hash) {
            return $this->hash;
        }

        if (0 === $this->count()) {
            throw new \RuntimeException('The array is empty - unable to get a hash.');
        }

        $this->hash = \current(\array_reduce(
            $this->storage,
            function ($carry) {
                if (1 === \count($carry) % 2) {
                    $carry[] = \end($carry);
                    return $carry;
                }

                return \array_map(
                    function ($pair) {
                        return $this->hasher->hash($pair[0].$pair[1]);
                    },
                    \array_chunk($carry, 2)
                );
            },
            \array_map([$this->hasher, 'hash'], $this->storage)
        ));

        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->storage);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->storage[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->storage[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (null !== $offset) {
            $this->storage[$offset] = $value;
        } else {
            $this->storage[] = $value;
        }

        $this->hash = null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->storage[$offset]);
        $this->hash = null;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \count($this->storage);
    }
}
