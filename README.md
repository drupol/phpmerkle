[![Latest Stable Version](https://poser.pugx.org/drupol/phpmerkle/v/stable)](https://packagist.org/packages/drupol/phpmerkle)
 [![Total Downloads](https://poser.pugx.org/drupol/phpmerkle/downloads)](https://packagist.org/packages/drupol/phpmerkle)
 [![Build Status](https://travis-ci.org/drupol/phpmerkle.svg?branch=master)](https://travis-ci.org/drupol/phpmerkle)
 [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/drupol/phpmerkle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/drupol/phpmerkle/?branch=master)
 [![Code Coverage](https://scrutinizer-ci.com/g/drupol/phpmerkle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/drupol/phpmerkle/?branch=master)
 [![Mutation testing badge](https://badge.stryker-mutator.io/github.com/drupol/phpmerkle/master)](https://stryker-mutator.github.io)
 [![License](https://poser.pugx.org/drupol/phpmerkle/license)](https://packagist.org/packages/drupol/phpmerkle)

# PhpMerkle

## Description

PHP implementation of a [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree).

## Documentation

API documentation is automatically generated with [APIGen](https://github.com/ApiGen/ApiGen) and available at [this address](https://not-a-number.io/phpmerkle/).

## Requirements

* PHP >= 7.1

## Installation

```composer require drupol/phpmerkle```

## Usage

The object has to be used just like a regular array.

```php
$merkle = new drupol\phpmerkle\Merkle();

$merkle[] = 'hello';
$merkle[] = 'world';

$merkle->hash(); // this returns: b9187808075710ab9c447c6ff6fd2aeb6c4bc10cf752e849102b87c0ecf97824

$merkle['key'] = 'value';

$merkle['key']; // this returns: 'value';
```
## Code quality and tests

Every time changes are introduced into the library, [Travis CI](https://travis-ci.org/drupol/phpmerkle/builds) run the tests.

The library has tests written with [PHPSpec](http://www.phpspec.net/).

Feel free to check them out in the `spec` directory. Run `composer phpspec` to trigger the tests.

## Contributing

Feel free to contribute to this library by sending Github pull requests. I'm quite reactive :-)
