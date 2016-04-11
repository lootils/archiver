# Lootils Archiver

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Create, extract and read archive files (zip, tar, phar, etc).

# Install

Via Composer

``` bash
$ composer require lootils/archiver
```

Optionally, for tar support, add `pear/archive_tar`:

``` bash
$ composer require pear/archive_tar
```

# Usage

Create a zip file:
``` php
$archive = \Lootils\Archiver\ZipArchive('myarchive.zip');
$archive->add('myfile.png');
```

Extract a .tar archive:
``` php
$archive = \Lootils\Archiver\TarArchive('myarchive.tar');
$archive->extract('destination');
```

List the contents of a .phar file:
``` php
$archive = \Lootils\Archiver\PharArchive('myarchive.phar');
$files = $archive->contents();
foreach ($files as $filename => $data) {
    echo $filename . ' ';
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Rob Loach][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lootils/archiver.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/lootils/archiver/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/lootils/archiver.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/lootils/archiver.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lootils/archiver.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lootils/archiver
[link-travis]: https://travis-ci.org/lootils/archiver
[link-scrutinizer]: https://scrutinizer-ci.com/g/lootils/archiver/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/lootils/archiver
[link-downloads]: https://packagist.org/packages/lootils/archiver
[link-author]: https://github.com/robloach
[link-contributors]: ../../contributors
