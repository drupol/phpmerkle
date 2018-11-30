<?php

namespace drupol\phpmerkle\benchmarks;

use Merkle\Leaf;
use Merkle\Tree;

/**
 * @Groups({"pitsolu/merkle-tree"})
 * @BeforeMethods({"initObject"})
 */
class PitsoluMerkleTreeBench extends AbstractBench
{
    /**
     * @var \Merkle\Tree
     */
    private $tree;

    public function initObject()
    {
        $data = $this->getData();

        // basically the same thing bitcoin merkle tree hashing does
        $hasher = function ($data) {
            return hash('sha256', hash('sha256', $data));
        };

        $this->tree = new Tree($hasher);

        foreach ($data as $key => $value) {
            $this->tree->add(new Leaf([$value]));
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
