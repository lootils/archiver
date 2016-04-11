<?php

/**
 * @file
 * Provides interaction with a Zip archive.
 */

namespace Lootils\Archiver;

use \ZipArchive as Zip;

/**
 * Read from and manipulate a zip archive.
 */
class ZipArchive implements ArchiveInterface
{
    /**
     * The zip archive itself.
     */
    protected $zip;

    /**
     * Construct a new archive.
     */
    public function __construct($path, $option = Zip::CREATE)
    {
        $this->zip = new Zip();
        if ($this->zip->open($path, $option) !== true) {
            throw new ArchiveException('Cannot open ' . $path);
        }
    }

    /**
     * Add the given file to the file archive.
     */
    public function add($file, $entry_name = null)
    {
        // Make sure to adapt the entry name as the original filename.
        if (!isset($entry_name)) {
            $entry_name = basename($file);
        }
        $result = $this->zip->addFile($file, $entry_name);
        if ($result === false) {
            throw new ArchiveException('Error adding ' . $file);
        }

        return $this;
    }

    /**
     * Remove the specified file from the archive.
     */
    public function remove($entry)
    {
        $result = $this->zip->deleteName($entry);
        if ($result === false) {
            throw new ArchiveException('Error removing entry ' . $entry);
        }

        return $this;
    }

    /**
     * Extract the given files to the destination.
     */
    public function extractTo($destination, $entries = array())
    {
        $result = false;
        if (!empty($entries)) {
            $result = $this->zip->extractTo($destination, $entries);
        } else {
            $result = $this->zip->extractTo($destination);
        }
        if ($result === false) {
            throw new ArchiveException('Error extracting archive.');
        }

        return $this;
    }

    /**
     * Retrieve an array of the archive contents.
     */
    public function contents()
    {
        $files = array();

        for ($i=0; $i < $this->zip->numFiles; $i++) {
            $details = $this->zip->statIndex($i);
            $files[$details['name']] = $details;
        }

        return $files;
    }

    /**
     * Closes the zip archive resource.
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Release the zip resource.
     */
    public function close()
    {
        if (isset($this->zip)) {
            $this->zip->close();
            $this->zip = null;
        }
    }
}
