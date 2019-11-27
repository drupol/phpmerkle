<?php

declare(strict_types=1);

namespace spec\drupol\phpmerkle;

use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Hasher\HasherInterface;
use drupol\phpmerkle\Merkle;
use drupol\phpmerkle\tests\DummyHasher;
use Exception;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use RuntimeException;

class MerkleSpec extends ObjectBehavior
{
    public function it_can_be_counted()
    {
        $this
            ->count()
            ->shouldBeInt();

        $this
            ->count()
            ->shouldReturn(0);

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

        $this
            ->count()
            ->shouldReturn(5);
    }

    public function it_can_cache_a_hash()
    {
        $this->beConstructedWith(2, new DummyHasher());

        $this->shouldThrow(Exception::class)->during('hash');

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

        $this->hash()->shouldReturn('ABCDEEEE');
        $this->hash()->shouldReturn('ABCDEEEE');
    }

    public function it_can_check_if_the_capacity_is_greater_than_one()
    {
        $this
            ->shouldThrow(InvalidArgumentException::class)
            ->during('__construct', [1, null]);
    }

    public function it_can_get_the_hasher()
    {
        $this
            ->getHasher()
            ->shouldBeAnInstanceOf(DoubleSha256::class);
    }

    public function it_can_hash()
    {
        $hasher = new DummyHasher();

        $this->beConstructedWith(2, $hasher);

        $this->shouldThrow(Exception::class)->during('hash');

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

        $this->hash()->shouldReturn('ABCDEEEE');

        $data = [
            'A',
            null,
            null,
            null,
            'E',
        ];

        foreach ($data as $key => $value) {
            $this[$key] = $value;
        }

        $this->hash()->shouldReturn('AAAAEEEE');

        $data = [
            0 => 'A',
            5 => 'E',
        ];

        foreach ($data as $key => $value) {
            $this[$key] = $value;
        }

        $this->hash()->shouldReturn('AAAAEEEE');
    }

    public function it_can_hash_with_no_parameters()
    {
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

        $this->shouldHaveType(Merkle::class);
        $this->hash()->shouldReturn('a46bfa668fa3a78141d2a9e349abc3d38c36b8d157202990beb611e0a446103f');
    }

    public function it_can_return_an_iterator()
    {
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

        $this
            ->getIterator()
            ->shouldIterateLike($data);
    }

    public function it_can_use_ArrayAccess_methods()
    {
        $hasher = new DummyHasher();

        $this->beConstructedWith(2, $hasher);

        $this->shouldThrow(Exception::class)->during('hash');

        $data = [
            0 => 'A',
            5 => 'E',
        ];

        foreach ($data as $key => $value) {
            $this[$key] = $value;
        }

        $this->offsetExists(0)->shouldReturn(isset($this[0]));
        $this->offsetGet(0)->shouldReturn($this[0]);
        $this->offsetUnset(0);
        $this->hash()->shouldReturn('EEEEEEEE');

        $this[0] = 'A';
        $this->hash()->shouldReturn('AAAAEEEE');

        $this->offsetUnset(5);
        $this->hash()->shouldReturn('AA');

        $this[] = 'E';
        $this->hash()->shouldReturn('AAAAEEEE');
    }

    public function it_is_initializable()
    {
        $hasher = new DummyHasher();

        $this
            ->beConstructedWith(2, $hasher);

        $this
            ->shouldThrow(RuntimeException::class)
            ->during('hash');

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

        $this->shouldHaveType(Merkle::class);

        $this->getHasher()->shouldBeAnInstanceOf(HasherInterface::class);
        $this->getCapacity()->shouldBeInt();
    }
}
