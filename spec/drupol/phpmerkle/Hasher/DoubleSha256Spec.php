<?php

namespace spec\drupol\phpmerkle\Hasher;

use drupol\phpmerkle\Hasher\DoubleSha256;
use PhpSpec\ObjectBehavior;

class DoubleSha256Spec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(DoubleSha256::class);
    }

    public function it_can_hash()
    {
        $data = 'hello world';

        $this->hash($data, false)->shouldReturn('049da052634feb56ce6ec0bc648c672011edff1cb272b53113bbc90a8f00249c');
    }

    public function it_can_hash_and_return_raw_output()
    {
        $data = 'hello world';

        $this->unpack($this->hash($data, true))->shouldReturn('bc62d4b80d9e36da29c16c5d4d9f11731f36052c72401a76c23c0fb5a9b74423');
    }
}
