<?php

declare(strict_types=1);

namespace spec\drupol\phpmerkle\Hasher;

use drupol\phpmerkle\Hasher\Sha256;
use PhpSpec\ObjectBehavior;

class Sha256Spec extends ObjectBehavior
{
    public function it_can_hash()
    {
        $data = 'hello world';

        $this->hash($data, false)->shouldReturn('b94d27b9934d3e08a52e52d7da7dabfac484efe37a5380ee9088f7ace2efcde9');
        $this->hash($data)->shouldNotReturn('b94d27b9934d3e08a52e52d7da7dabfac484efe37a5380ee9088f7ace2efcde9');
        $this->hash($data)->shouldReturn(hash('sha256', $data, true));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Sha256::class);
    }
}
