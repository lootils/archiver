<?php

/**
 * @file
 * Provides interaction with a Tar archive.
 */

namespace Lootils\Archiver;

use \Archive_Tar as Tar;

/**
 * Read from and manipulate a tar archive.
 */
class TarArchive implements ArchiveInterface
{
    /**
     * The zip archive itself.
     */
    protected $tar;

    /**
     * Construct a new archive.
     */
    public function __construct($path, $option = null)
    {
        $this->tar = new Tar($path, $option);
    }

    /**
     * Add the given file to the file archive.
     */
    public function add($file, $entry_name = null)
    {
        $result = $this->tar->addModify($file, '', dirname($file));
        if ($result === false) {
            throw new ArchiveException('Error adding file ' . $file);
        }

        return $this;
    }

    /**
     * Files cannot be removed from the tar archive.
     */
    public function remove($entry)
    {
        return $this;
    }

    /**
     * Extract the given files to the destination.
     */
    public function extractTo($destination, $entries = array())
    {
        $result = false;
        if (!empty($entries)) {
            $result = $this->tar->extractList($entries, $destination);
        } else {
            $result = $this->tar->extract($destination, true);
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
        foreach ($this->tar->listContent() as $data) {
          $files[$data['filename']] = $data;
        }

        return $files;
    }

    /**
     * Closes the tar archive resource.
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Release the tar resource.
     */
    public function close()
    {
        if ($this->tar) {
            unset($this->tar);
        }
    }
}
