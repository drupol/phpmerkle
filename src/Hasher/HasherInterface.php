<?php

declare(strict_types = 1);

namespace drupol\phpmerkle\Hasher;

/**
 * Interface HasherInterface
 */
interface HasherInterface
{
    /**
     * Get a hash of a string.
     *
     * @param string $data
     *   The input string.
     *
     * @return string
     *   The output string, hashed.
     */
    public function hash(string $data): string;

    /**
     * @param string|null $data
     *
     * @return string
     */
    public function unpack(string $data = null): string;
}
