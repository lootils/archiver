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
        $archive = new $this->class(__DIR__.'/Resources/php.'.$this->extension);

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
        $archive->add(__DIR__.'/Resources/php.png');

        // Construct the expected results.
        $expected = array('php.png');

        // Check what's in the archive.
        $contents = $archive->contents();
        $result = array_keys($contents);

        // Compare the results.
        $this->assertEquals($expected, $result);
    }

    /**
     * Tests extracting an archive to a directory.
     */
    public function testExtractTo()
    {
        // Make sure we have a temporary directory to extract the archive.
        $dir = tempnam(sys_get_temp_dir(), 'archiver');
        if (file_exists($dir)) {
            unlink($dir);
        }
        mkdir($dir, 0777, true);

        // Load the archive.
        $archive = new $this->class(__DIR__ . '/Resources/php.' . $this->extension);

        // Extract to the temporary directory.
        $archive->extractTo($dir);

        // Check that the file is present.
        $files = scandir($dir, 1);
        if ($files) {
            $this->assertEquals($files[0], 'php.png');
        } else {
            $this->fail('Temporary directory does not exist.');
        }
    }

    /**
     * Tests removing a file from an archive.
     */
    public function testRemove()
    {
        // Copy the archive to a temporary file.
        $temp_file = tempnam(sys_get_temp_dir(), 'archiver');
        copy(__DIR__.'/Resources/php.'.$this->extension, $temp_file);

        // Remove php.png from the archive.
        $archive = new $this->class($temp_file);
        $archive->remove('php.png');
        $archive->close();

        // Re-open the archive, and check that png.png is gone.
        $archive = new $this->class($temp_file);
        $result = $archive->contents();
        $this->assertEquals(array(), $result);
    }
}
