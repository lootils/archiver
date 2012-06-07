<?php

namespace Lootils\Archiver\Test;

use Lootils\Archiver\TarArchive;

class TarArchiveTest extends \PHPUnit_Framework_TestCase
{
    public function testContents()
    {
        // Open the zip archive.
        $tar = new TarArchive(__DIR__.'/php.tar');

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $tar->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }

    public function testAdd()
    {
        // Create a temporary file.
        $temp_file = tempnam(sys_get_temp_dir(), 'archiver');

        // Create the archive and add php.png.
        $tar = new TarArchive($temp_file);
        $tar->add(__DIR__.'/php.png');

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $tar->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }
}
