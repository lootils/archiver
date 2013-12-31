<?php

/**
 * @file
 * Provides interaction with a Phar archive.
 */

namespace Lootils\Archiver;

use Phar;

/**
 * Read from and manipulate a phar archive.
 */
class PharArchive implements ArchiveInterface
{
    /**
     * The phar archive itself.
     */
    protected $phar;
    protected $path;

    /**
     * Construct a new archive.
     */
    public function __construct($path, $flags = 0)
    {
        $this->path = $path;
        $this->phar = new Phar($path);
    }

    /**
     * Add the given file to the file archive.
     */
    public function add($file, $entry_name = null)
    {
        // Make sure to adapt the entry name as the original filename.
        if (isset($entry_name)) {
            $this->phar->addFile($file, $entry_name);
        }
        else {
            $this->phar->addFile($file);
        }

        return $this;
    }

    /**
     * Remove the specified file from the archive.
     */
    public function remove($entry)
    {
        $result = $this->phar->delete($entry);
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
            $result = $this->phar->extractTo($destination, $entries);
        } else {
            $result = $this->phar->extractTo($destination);
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

        // Phar files must be reloaded to have updated contents.
        $this->phar = new Phar($this->path);

        foreach ($this->phar as $file) {
            $name = basename($file);
            $files[$name] = $this->phar[$name];
        }

        return $files;
    }

    /**
     * Release the phar resource.
     */
    public function close()
    {
        unset($this->phar);
    }
}
