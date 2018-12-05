<?php

namespace spec\drupol\phpmerkle;

use drupol\phpmerkle\Merkle;
use drupol\phpmerkle\tests\DummyHasher;
use PhpSpec\ObjectBehavior;

class MerkleSpec extends ObjectBehavior
{
    public function let()
    {
        $hasher = new DummyHasher();

        $this->beConstructedWith(2, $hasher);

        $this->shouldThrow(\Exception::class)->during('hash');

        $data = [
            'A',
            'B',
            'C',
            'D',
            'E',
        ];

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Merkle::class);
    }

    public function it_can_hash()
    {
        $this->hash()->shouldReturn('ABCDEEEE');
    }

    public function it_can_cache_a_hash()
    {
        $this->hash()->shouldReturn('ABCDEEEE');
        $this->hash()->shouldReturn('ABCDEEEE');
    }

    public function it_can_hash_another_dataset()
    {
        $hasher = new DummyHasher();

        $this->beConstructedWith(2, $hasher);

        $this->shouldThrow(\Exception::class)->during('hash');

        $data = [
            0 => 'A',
            7 => 'E',
        ];

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }

        $this
            ->hash()
            ->shouldReturn('AAAAEEEE');
    }
}
