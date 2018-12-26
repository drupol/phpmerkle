<?php

namespace spec\drupol\phpmerkle;

use drupol\phpmerkle\Merkle;
use drupol\phpmerkle\tests\DummyHasher;
use PhpSpec\ObjectBehavior;

class MerkleSpec extends ObjectBehavior
{
    public function let()
    {
    }

    public function it_is_initializable()
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

        $this->shouldHaveType(Merkle::class);
    }

    public function it_can_hash()
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

        $this->hash()->shouldReturn('ABCDEEEE');

        $data = [
            'A',
            NULL,
            NULL,
            NULL,
            'E',
        ];

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }

        $this->hash()->shouldReturn('AAAAEEEE');

        $data = [
            0 => 'A',
            5 => 'E',
        ];

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }

        $this->hash()->shouldReturn('AAAAEEEE');
    }

    public function it_can_cache_a_hash()
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

        $this->hash()->shouldReturn('ABCDEEEE');
        $this->hash()->shouldReturn('ABCDEEEE');
    }
}
