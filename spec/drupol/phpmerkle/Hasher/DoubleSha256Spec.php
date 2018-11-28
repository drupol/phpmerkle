<?php

namespace spec\drupol\phpmerkle\Hasher;

use drupol\phpmerkle\Hasher\DoubleSha256;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DoubleSha256Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(DoubleSha256::class);
    }

    public function it_can_hash()
    {
        $data = 'hello world';

        $this->hash($data)->shouldReturn('049da052634feb56ce6ec0bc648c672011edff1cb272b53113bbc90a8f00249c');
    }
}
