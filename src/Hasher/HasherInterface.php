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
     * @param bool $raw_output
     *   Raw output.
     *
     * @return string
     *   The output string, hashed.
     */
    public function hash(string $data, bool $raw_output = true): string;

    /**
     * @param string|null $data
     *
     * @return string
     */
    public function unpack(string $data = null): string;
}
