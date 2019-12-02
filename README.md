[![Latest Stable Version](https://img.shields.io/packagist/v/drupol/phpmerkle.svg?style=flat-square)](https://packagist.org/packages/drupol/phpmerkle)
 [![GitHub stars](https://img.shields.io/github/stars/drupol/phpmerkle.svg?style=flat-square)](https://packagist.org/packages/drupol/phpmerkle)
 [![Total Downloads](https://img.shields.io/packagist/dt/drupol/phpmerkle.svg?style=flat-square)](https://packagist.org/packages/drupol/phpmerkle)
 [![GitHub Workflow Status](https://img.shields.io/github/workflow/status/drupol/phpmerkle/Continuous%20Integration?style=flat-square)](https://github.com/drupol/phpmerkle/actions)
 [![Scrutinizer code quality](https://img.shields.io/scrutinizer/quality/g/drupol/phpmerkle/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/drupol/phpmerkle/?branch=master)
 [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/drupol/phpmerkle/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/drupol/phpmerkle/?branch=master)
 [![Mutation testing badge](https://badge.stryker-mutator.io/github.com/drupol/phpmerkle/master)](https://stryker-mutator.github.io)
 [![Read the Docs](https://img.shields.io/readthedocs/phpmerkle?style=flat-square)](https://phpmerkle.readthedocs.io/)
 [![License](https://img.shields.io/packagist/l/drupol/phpmerkle.svg?style=flat-square)](https://packagist.org/packages/drupol/phpmerkle)
 [![Say Thanks!](https://img.shields.io/badge/Say-thanks-brightgreen.svg?style=flat-square)](https://saythanks.io/to/drupol)
 [![Donate!](https://img.shields.io/badge/Donate-Paypal-brightgreen.svg?style=flat-square)](https://paypal.me/drupol)

# PhpMerkle

A fast PHP implementation of the [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree) using simple arrays.

## Documentation

TODO.

## Requirements

* PHP >= 7.1

## Installation

```composer require drupol/phpmerkle```

## Usage

The object has to be used just like a regular array.

```php
<?php

declare(strict_types=1);

include './vendor/autoload.php';

$tree = new drupol\phpmerkle\Merkle();

$sentence = 'Science is made up of so many things that appear obvious after they are explained .';

foreach (explode(' ', $sentence) as $word) {
    $tree[] = $word;
}

echo $tree->hash(); // c689102cdf2a5b30c2e21fdad85e4bb401085227aff672a7240ceb3410ff1fb6
```
## Code quality, tests and benchmarks

Every time changes are introduced into the library, [Github](https://github.com/drupol/phpmerkle/actions) run the tests and the benchmarks.

The library has tests written with [PHPSpec](http://www.phpspec.net/).
Feel free to check them out in the `spec` directory. Run `composer phpspec` to trigger the tests.

Before each commit some inspections are executed with [GrumPHP](https://github.com/phpro/grumphp), run `./vendor/bin/grumphp run` to check manually.

[PHPBench](https://github.com/phpbench/phpbench) is used to benchmark the library, to run the benchmarks: `composer bench`

[PHPInfection](https://github.com/infection/infection) is used to ensure that your code is properly tested, run `composer infection` to test your code.

## Contributing

Feel free to contribute to this library by sending Github pull requests. I'm quite reactive :-)
