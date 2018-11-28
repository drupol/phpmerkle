<?php

namespace spec\drupol\phpmerkle;

use drupol\phpmerkle\Merkle;
use drupol\phpmerkle\tests\DummyHasher;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MerkleSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith([]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Merkle::class);
    }

    public function it_can_hash()
    {
        $data = [
            'hello',
            'world',
            'foo',
            'bar',
            'w00t',
        ];

        $this->beConstructedWith($data);

        $this->hash()->shouldReturn('b556d5b958793e016e7d77b9d1f0526130a8dad34ebf317988bde0cd2fc0c789');
    }

    public function it_can_be_used_like_an_array()
    {
        $data = [
            'hello',
            'world',
            'foo',
            'bar',
            'w00t',
        ];

        foreach ($data as $key => $item) {
            $this[] = $item;
        }

        $this->hash()->shouldReturn('b556d5b958793e016e7d77b9d1f0526130a8dad34ebf317988bde0cd2fc0c789');
    }

    public function it_throw_an_error_when_trying_to_get_the_hash_of_empty_array()
    {
        $this->shouldThrow(\RuntimeException::class)->during('hash');
    }

    public function it_can_return_an_iterator()
    {
        $this->getIterator()->shouldImplement(\Iterator::class);
    }

    public function it_can_cache_a_hash()
    {
        $data = [
            'hello',
            'world',
            'foo',
            'bar',
            'w00t',
        ];

        foreach ($data as $key => $item) {
            $this[] = $item;
        }

        $this->hash()->shouldReturn('b556d5b958793e016e7d77b9d1f0526130a8dad34ebf317988bde0cd2fc0c789');
        $this->hash()->shouldReturn('b556d5b958793e016e7d77b9d1f0526130a8dad34ebf317988bde0cd2fc0c789');
    }

    public function it_extends_arrayaccess()
    {
        $data = [
            'hello',
            'world',
            'foo',
            'bar',
            'w00t',
        ];

        $this->beConstructedWith($data);

        $this->offsetExists(0)->shouldReturn(true);
        $this->offsetExists(5)->shouldReturn(false);
        $this[0]->shouldReturn('hello');
        $this[6] = 'merkle';
        unset($this[6]);

        $this->hash()->shouldReturn('b556d5b958793e016e7d77b9d1f0526130a8dad34ebf317988bde0cd2fc0c789');
    }

    public function it_can_use_another_hasher()
    {
        $data = [
            'hello',
            'world',
            'foo',
            'bar',
            'w00t',
        ];

        $this->beConstructedWith($data, new DummyHasher());

        $this->hash()->shouldReturn('dummy');
    }
}
