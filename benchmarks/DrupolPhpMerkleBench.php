<?php

namespace drupol\phpmerkle\benchmarks;

use drupol\htmltag\Attribute\Attribute;
use drupol\htmltag\Attribute\AttributeFactory;
use drupol\htmltag\Attributes\Attributes;
use drupol\htmltag\Attributes\AttributesFactory;
use drupol\htmltag\HtmlTag;
use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Merkle;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use Pleo\Merkle\FixedSizeTree;

/**
 * @Groups({"drupol/phpmerkle"})
 * @BeforeMethods({"initObject"})
 */
class DrupolPhpMerkleBench extends AbstractBench
{
    public function initObject()
    {
        $data = $this->getData();

        $hasher = new DoubleSha256();

        $this->tree = new Merkle($data, $hasher);
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
