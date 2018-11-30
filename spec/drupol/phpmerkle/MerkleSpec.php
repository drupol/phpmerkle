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
        $this->beConstructedWith([], new DummyHasher());

        $this->shouldThrow(\Exception::class)->during('hash');

        $data = [
            'A',
            'B',
            'C',
            'D',
            'E',
        ];

        foreach ($data as $key => $value) {
            $this[$key] = $value;
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

    public function it_can_be_used_like_an_array()
    {
        $this[] = 'F';

        $this->hash()->shouldReturn('ABCDEFEF');
    }

    public function it_can_return_an_iterator()
    {
        $this->getIterator()->shouldImplement(\Iterator::class);
    }

    public function it_can_cache_a_hash()
    {
        $this->hash()->shouldReturn('ABCDEEEE');
        $this->hash()->shouldReturn('ABCDEEEE');
    }

    public function it_extends_arrayaccess()
    {
        $this->offsetExists(0)->shouldReturn(true);
        $this->offsetExists(5)->shouldReturn(false);
        $this[0]->shouldReturn('A');
        $this[6] = 'F';
        unset($this[6]);

        $this->hash()->shouldReturn('ABCDEEEE');
    }

    public function it_can_get_the_tree_depth()
    {
        $this->depth()->shouldReturn(3);
        $this[] = 'F';
        $this->depth()->shouldReturn(3);
        $this[] = 'G';
        $this->depth()->shouldReturn(3);
        $this[] = 'H';
        $this->depth()->shouldReturn(4);
    }

    public function it_can_get_levels()
    {
        $this->level(0)->shouldReturn(['ABCDEEEE']);
        $this->level(1)->shouldReturn(['ABCD', 'EEEE']);
        $this->level(2)->shouldReturn(['AB', 'CD', 'EE']);
        $this->level(3)->shouldReturn(['A', 'B', 'C', 'D', 'E']);

        $this->shouldThrow(\InvalidArgumentException::class)->during('level', [4]);
    }
}
