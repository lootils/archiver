<?php

/**
 * @file
 * Abstraction interface for interfacing with file archives.
 */

namespace Lootils\Archiver;

/**
 * Common interface for all file archives.
 */
interface ArchiveInterface {

    /**
     * Construct a new archive.
     */
    public function __construct($path, $option = null);

    /**
     * Add the given file to the file archive.
     */
    public function add($file, $entry_name = null);

    /**
     * Remove the specified file from the archive.
     */
    public function remove($entry);

    /**
     * Extract the given files to the destination.
     */
    public function extractTo($destination, $files = array());

    /**
     * Retrieve an array of the archive contents.
     */
    public function contents();

    /**
     * Release the resource.
     */
    public function close();
}
