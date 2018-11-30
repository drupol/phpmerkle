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
    public function depth(): int
    {
        return (int) \floor(\log($this->count(), 2)) + 1;
    }

    /**
     * {@inheritdoc}
     */
    public function level(int $level): array
    {
        $levels = $this->depth();

        if ($level > $levels) {
            throw new \InvalidArgumentException('Invalid level.');
        }

        $storage = \array_map([$this->hasher, 'hash'], $this->storage);

        for ($i = $levels-1; $i >= $level; $i--) {
            $storage = $this->reduceArrayToHash($storage);
        }

        return $storage;
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
            [$this, 'reduceArrayToHash'],
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

    /**
     * Reduce an array by transforming pair of values into a single hash.
     *
     * @param array $data
     *   The data array.
     *
     * @return array
     *   The hashes array.
     */
    private function reduceArrayToHash(array $data): array
    {
        $count = \count($data);

        if (1 === $count) {
            return $data;
        }

        if (1 ===  $count % 2) {
            $data[] = \end($data);
        }

        return \array_map(
            function ($chunk) {
                return $this->hasher->hash($chunk[0] . $chunk[1]);
            },
            \array_chunk($data, 2)
        );
    }
}
