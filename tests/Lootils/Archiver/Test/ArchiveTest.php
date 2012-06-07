<?php

namespace Lootils\Archiver\Test;

/**
 * Generic test framework to test manipulation of file archives.
 */
abstract class ArchiveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The class assigned for the archive.
     */
    protected $class;

    /**
     * File extension used to build the archive.
     */
    protected $extension;

    /**
     * Tests calling the $archive->contents() function.
     */
    public function testContents()
    {
        // Open the zip archive.
        $archive = new $this->class(__DIR__.'/php.'.$this->extension);

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $archive->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests calling the $archive->add() function.
     */
    public function testAdd()
    {
        // Create a temporary file.
        $temp_file = tempnam(sys_get_temp_dir(), 'archiver');

        // Create the archive and add php.png.
        $archive = new $this->class($temp_file);
        $archive->add(__DIR__.'/php.png');

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $archive->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }
}
