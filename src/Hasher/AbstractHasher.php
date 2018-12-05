<?php

namespace drupol\phpmerkle\Hasher;

/**
 * Class AbstractHasher
 */
abstract class AbstractHasher implements HasherInterface
{
    /**
     * Do the hash.
     *
     * @param string $algo
     *   The algorithm to use
     * @param string $data
     *   The data to hash.
     * @param bool $raw_output
     *   When set to TRUE, outputs raw binary data.
     *   FALSE outputs lowercase a hex string.
     *
     * @return string
     *   The hash.
     */
    protected function doHash(string $algo, string $data, bool $raw_output = false)
    {
        return \hash($algo, $data, $raw_output);
    }
}