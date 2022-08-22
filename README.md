# bitmap-tools

![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/smoren/bitmap-tools)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Smoren/bitmap-tools-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Smoren/bitmap-tools-php/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/Smoren/bitmap-tools-php/badge.svg?branch=master)](https://coveralls.io/github/Smoren/bitmap-tools-php?branch=master)
![Build and test](https://github.com/Smoren/bitmap-tools-php/actions/workflows/test_master.yml/badge.svg)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Tools for working with bitmaps

### How to install to your project
```
composer require smoren/bitmap-tools
```

### Unit testing
```
composer install
composer test-init
composer test
```

### Usage

#### Simple usage

```php
use Smoren\BitmapTools\Models\Bitmap;

// Create bitmap by int value:
$bm = Bitmap::create(6); // bitmap: 110

// Create bitmap by true bit positions:
$bm = Bitmap::create([1, 2]); // bitmap: 110

// Basic operations:
$bm = Bitmap::create([0, 2]);
var_dump($bm->getValue()); // 5
var_dump($bm->toArray()); // [0, 2]
var_dump($bm->hasBit(0)); // true
var_dump($bm->hasBit(1)); // false
var_dump($bm->hasBit(2)); // true

$bm = Bitmap::create([0, 1, 2]);
var_dump($bm->getValue()); // 7
var_dump($bm->toArray()); // [0, 1, 2]

$bm = Bitmap::create([]);
var_dump($bm->getValue()); // 0
var_dump($bm->toArray()); // []

// Intersections:
$bm = Bitmap::create(7);
var_dump($bm->intersectsWith(Bitmap::create(1))); // true
var_dump($bm->intersectsWith(Bitmap::create([1, 2]))); // true

$bm = Bitmap::create(6);
var_dump($bm->intersectsWith(Bitmap::create(2))); // true
var_dump($bm->intersectsWith(Bitmap::create(0))); // false

// Inclusions:
$bm = Bitmap::create(6);
var_dump($bm->includes(Bitmap::create(2))); // true (in binary numbers: 110 includes 010)
var_dump($bm->includes(Bitmap::create(1))); // false (in binary numbers: 110 not includes 001)
var_dump($bm->includes(Bitmap::create(3))); // false (in binary numbers: 110 not includes 011)

// Additions:
$bm = Bitmap::create(2); // bitmap: 010
$bm = $bm->add(Bitmap::create(1)); // bitmap: 011
$bm = $bm->add(Bitmap::create(6)); // bitmap: 111

// Subtractions:
$bm = Bitmap::create(15); // bitmap: 1111
$bm = $bm->sub(Bitmap::create(6)); // bitmap: 1001
$bm = $bm->sub(Bitmap::create(3)); // bitmap: 1000
```
