<?php

namespace drupol\phpmerkle\benchmarks;

use Pleo\Merkle\FixedSizeTree;

/**
 * @Groups({"pleonasm/merkle-tree"})
 * @BeforeMethods({"initObject"})
 */
class PleonasmMerkleTreeBench extends AbstractBench
{
    /**
     * @var FixedSizeTree
     */
    private $tree;

    /**
     * @var callable
     */
    private $hasher;

    /**
     * Init the object.
     */
    public function initObject()
    {
        $this->hasher = function ($data) {
            return \hash('sha256', \hash('sha256', $data));
        };
    }

    /**
     * @Revs({1, 100, 1000})
     * @Iterations(5)
     * @Warmup(10)
     */
    public function benchHash()
    {
        $data = $this->getData();
        $this->tree = new FixedSizeTree(\count($data), $this->hasher);

        foreach ($data as $key => $value) {
            $this->tree->set($key, $value);
        }

        $this->tree->hash();
    }
}
