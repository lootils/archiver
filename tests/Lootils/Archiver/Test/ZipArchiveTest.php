<?php

namespace Lootils\Archiver\Test;

use Lootils\Archiver\ZipArchive;

class ZipArchiveTest extends \PHPUnit_Framework_TestCase
{
    public function testContents()
    {
        // Open the zip archive.
        $zip = new ZipArchive(__DIR__.'/php.zip');

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $zip->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }

    public function testAdd()
    {
        // Create a temporary file.
        $temp_file = tempnam(sys_get_temp_dir(), 'archiver');

        // Create the archive and add php.png.
        $zip = new ZipArchive($temp_file);
        $zip->add(__DIR__.'/php.png');

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $zip->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }
}
