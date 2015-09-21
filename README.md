# wp-disable-auto-update

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gwa/wp-disable-auto-update.svg?style=flat-square)](https://packagist.org/packages/gwa/wp-disable-auto-update)
[![Total Downloads](https://img.shields.io/packagist/dt/gwa/wp-disable-auto-update.svg?style=flat-square)](https://packagist.org/packages/gwa/wp-disable-auto-update)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Master

[![Build Status](https://img.shields.io/travis/gwa/wp-disable-auto-update/master.svg?style=flat-square)](https://travis-ci.org/gwa/wp-disable-auto-update)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/gwa/wp-disable-auto-update.svg?style=flat-square)](https://scrutinizer-ci.com/g/gwa/wp-disable-auto-update/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/gwa/wp-disable-auto-update.svg?style=flat-square)](https://scrutinizer-ci.com/g/gwa/wp-disable-auto-update)

## Develop

[![Build Status](https://img.shields.io/travis/gwa/wp-disable-auto-update/master.svg?style=flat-square)](https://travis-ci.org/gwa/wp-disable-auto-update)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/gwa/wp-disable-auto-update.svg?style=flat-square)](https://scrutinizer-ci.com/g/gwa/wp-disable-auto-update/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/gwa/wp-disable-auto-update.svg?style=flat-square)](https://scrutinizer-ci.com/g/gwa/wp-disable-auto-update)

## Install

Via Composer

``` bash
$ composer require gwa/wp-disable-auto-update
```

## Usage

First init DisableAutoUpdateHandler class.
``` php
$disableUpdates = (new DisableAutoUpdateHandler())->init();
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daniel Bannert](https://github.com/prisis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
