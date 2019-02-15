<?php

declare(strict_types = 1);

namespace drupol\phpmerkle\Hasher;

/**
 * Interface HasherInterface.
 */
interface HasherInterface
{
    /**
     * Get a hash of a string.
     *
     * @param string $data
     *   The input string
     * @param bool $raw_output
     *   Raw output
     *
     * @return string
     *   The output string, hashed
     */
    public function hash(string $data, bool $raw_output = true): string;

    /**
     * Unpack binary data.
     *
     * @param string $data
     *   The binary data
     *
     * @return string
     *   The string
     */
    public function unpack(string $data): string;
}
