<?php

namespace Lootils\Archiver\Test;

class PharArchiveTest extends ArchiveTest
{
    public function setUp()
    {
        parent::setUp();

        $this->class = 'Lootils\Archiver\PharArchive';
        $this->extension = 'phar';
    }

    /**
     * PharArchive currently does not support removing the entries.
     */
    public function testRemove()
    {
        return true;
    }
}
