<?php

/**
 * @file
 * Provides interaction with a Zip archive.
 */

namespace Lootils\Archiver;

use Lootils\Archiver\Tar\ArchiveTar;

/**
 * Read from and manipulate a zip archive.
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
    public function __construct($path)
    {
        $this->tar = new \Archive_Tar($path);
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
        if (isset($entries)) {
            $result = $this->tar->extractList($files, $path);
        } else {
            $result = $this->tar->extract($path);
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
        if ($this->tar) {
            unset($this->tar);
        }
    }
}
