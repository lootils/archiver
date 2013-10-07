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
$zip = \Lootils\Archiver\ZipArchive('myarchive.zip');
$zip->add('myfile.png');
```

Extract a .tar archive:
```php
$tar = \Lootils\Archiver\TarArchive('myarchive.tar');
$$tar->extract('destination');
```

List the contents of an archive:
```php
$tar = \Lootils\Archiver\TarArchive('myarchive.tar');
$files = $tar->contents();
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
