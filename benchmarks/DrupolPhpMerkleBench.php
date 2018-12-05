<?php

namespace drupol\phpmerkle\benchmarks;

use drupol\phpmerkle\Merkle;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;

/**
 * @Groups({"drupol/phpmerkle"})
 * @BeforeMethods({"initObject"})
 */
class DrupolPhpMerkleBench extends AbstractBench
{
    /**
     * @var \drupol\phpmerkle\Node\MerkleNodeInterface
     */
    private $tree;

    /**
     * Init the object.
     */
    public function initObject()
    {
    }

    /**
     * @Revs({1, 100, 1000})
     * @Iterations(5)
     * @Warmup(10)
     */
    public function benchHash()
    {
        $this->tree = new Merkle();

        foreach ($this->getData() as $key => $value) {
            $this->tree->set($key, $value);
        }

        $this->tree->hash();
    }
}
