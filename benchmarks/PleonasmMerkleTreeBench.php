<?php

namespace drupol\phpmerkle\benchmarks;

use Pleo\Merkle\FixedSizeTree;

/**
 * @Groups({"pleonasm/merkle-tree"})
 * @BeforeMethods({"initObject"})
 */
class PleonasmMerkleTreeBench extends AbstractBench
{
    public function initObject()
    {
        $data = $this->getData();

        // basically the same thing bitcoin merkle tree hashing does
        $hasher = function ($data) {
            return hash('sha256', hash('sha256', $data));
        };

        $this->tree = new FixedSizeTree(count($data), $hasher);

        foreach ($data as $key => $value) {
            $data[$key] = $value;
        }
    }

    /**
     * @Revs({1, 100, 1000})
     * @Iterations(5)
     * @Warmup(10)
     */
    public function benchHash()
    {
        $this->tree->hash();
    }
}
