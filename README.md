Lootils Archiver
==============

An abstraction library to interface with file archives.

[![Build Status](https://secure.travis-ci.org/lootils/archiver.png?branch=master)](http://travis-ci.org/lootils/archiver)


Installation
-----------

Install Lootils Archiver by adding `lootils/archiver` to your *composer.json*
file.
```json
{
    "require": {
        "lootils/archiver": "*"
    }
}
```


Usage
-----

Create a zip file:
```php
$archive = \Lootils\Archiver\ZipArchive('myarchive.zip');
$archive->add('myfile.png');
```

Extract a .tar archive:
```php
$archive = \Lootils\Archiver\TarArchive('myarchive.tar');
$archive->extract('destination');
```

List the contents of a .phar file:
```php
$archive = \Lootils\Archiver\PharArchive('myarchive.phar');
$files = $archive->contents();
foreach ($files as $filename => $data) {
    echo $filename . ' ';
}
```


Dependencies
------------

In order to interact with tar archives, make sure to add `pear/archive_tar` to
your *composer.json* file.


Development
----------

To install development tools, run the following:
```bash
curl -s http://getcomposer.org/installer | php
php composer.phar install
```

Run tests:
```bash
phpunit
```


License
-------

This library is available under a MIT license.
