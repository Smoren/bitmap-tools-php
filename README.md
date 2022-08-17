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
use Smoren\BitmapTools\Helpers\BitmapHelper;

// Let's create bitmaps from specified bit's positions:
var_dump(BitmapHelper::create([0, 1, 2])); // 7
var_dump(BitmapHelper::create([0, 2])); // 5
var_dump(BitmapHelper::create([])); // 0

// Let's parse bitmaps to get arrays of it's bit's positions:
print_r(BitmapHelper::parse(7)); // [0, 1, 2]
print_r(BitmapHelper::parse(5)); // [0, 2]
print_r(BitmapHelper::parse(0)); // []

// Intersections (you can specify arguments as bitmaps or arrays of bit positions):
var_dump(BitmapHelper::intersects(7, 1)); // true
var_dump(BitmapHelper::intersects([0, 1, 2], 1)); // true
var_dump(BitmapHelper::intersects([0, 1, 2], [1, 2])); // true

var_dump(BitmapHelper::intersects(6, 0)); // false
var_dump(BitmapHelper::intersects([1, 2], 1)); // true
var_dump(BitmapHelper::intersects([0, 2], [1])); // true

// Inclusions (you can specify arguments as bitmaps or arrays of bit positions):
var_dump(BitmapHelper::includes(7, 1)); // true (in binary numbers: 111 includes 001)
var_dump(BitmapHelper::includes([0, 1, 2], 1)); // true
var_dump(BitmapHelper::includes(7, [0])); // true

var_dump(BitmapHelper::includes(1, 7)); // false (in binary numbers: 001 not includes 111)
var_dump(BitmapHelper::includes([0], 7)); // false
var_dump(BitmapHelper::includes(1, [0, 1, 2])); // false
```
