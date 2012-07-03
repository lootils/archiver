<?php

namespace Lootils\Archiver\Test;

class TarArchiveTest extends ArchiveTest
{
    public function setUp()
    {
        parent::setUp();

        $this->class = 'Lootils\Archiver\TarArchive';
        $this->extension = 'tar';
    }

    /**
     * Tar does not support removing files, so we just skip this test.
     */
    public function testRemove()
    {
        return true;
    }
}
